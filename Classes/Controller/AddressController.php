<?php
namespace Undkonsorten\Addressmgmt\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use Undkonsorten\Addressmgmt\Domain\Repository\CategoryRepository;

use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\Exception\TooDirtyException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter;
use Undkonsorten\Addressmgmt\Domain\Model\AddressInterface;
use Undkonsorten\Addressmgmt\Domain\Model\Address;
use TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentTypeException;
use Undkonsorten\Addressmgmt\Domain\Repository\AddressRepository;
use Undkonsorten\Addressmgmt\Service\AddressLocatorService;
use Undkonsorten\Addressmgmt\Service\CategoryService;

use Undkonsorten\Addressmgmt\Domain\Model\Address\Person;
use Undkonsorten\Addressmgmt\Domain\Model\Address\Organisation;
use Undkonsorten\Addressmgmt\Domain\Model\Address\Location;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Felix Althaus <felix.althaus@undkonsorten.com>, undkonsorten
 *  Eike Starkmann <eike.starkmann@undkonsorten.com>, undkonsorten
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package addressmgmt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AddressController extends BaseController
{

    /**
     * @var AddressRepository
     */
    protected $addressRepository;

    public function injectAddressRepository(AddressRepository $addressRepository): void
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function injectCategoryRepository(CategoryRepository $categoryRepository): void
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @var CategoryService
     */
    protected $categoryService;

    public function injectCategoryService(CategoryService $categoryService): void
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @var AddressLocatorService
     */
    protected $addressService;

    public function injectAddressService(AddressLocatorService $addressService): void
    {
        $this->addressService = $addressService;
    }

    /**
     * @var PersistenceManager
     */
    protected $persistenceManager;

    public function injectPersistenceManager(PersistenceManager $persistenceManager): void
    {
        $this->persistenceManager = $persistenceManager;
    }


    /**
     * Constructor
     */
    public function initializeAction(): void
    {
        $arguments = $this->request->getArguments();
        if (isset($arguments['address']['category']) && is_array($arguments['address']['category'])) {
            foreach ($arguments['address']['category'] as $key => $value) {
                /** @noinspection TypeUnsafeComparisonInspection */
                if ($value == 0) {
                    unset($arguments['address']['category'][$key]);
                }
            }
            $this->request->withArguments($arguments);
        }

        if(isset($this->arguments['address'])){
            $propertyMappingConfiguration = $this->arguments['address']->getPropertyMappingConfiguration();
            $propertyMappingConfiguration->allowProperties('type');
            $propertyMappingConfiguration->setTypeConverterOption(PersistentObjectConverter::class, PersistentObjectConverter::CONFIGURATION_OVERRIDE_TARGET_TYPE_ALLOWED, TRUE);
        }
    }

    /**
     * @throws StopActionException
     * @throws UnknownObjectException
     * @throws IllegalObjectTypeException
     */
    public function handInForReviewAction(Address $address): ResponseInterface
    {
        $address->setPublishState(Address::PUBLISH_WAITING);
        $this->addressRepository->update($address);
        $this->addFlashMessage($this->localize('flashMessage.handInForReview'),AbstractMessage::OK);
        $this->redirect('dash');

    }

    /**
     * @throws Exception
     * @throws InvalidArgumentTypeException
     * @throws IllegalObjectTypeException
     */
    public function dashAction(): ResponseInterface
    {
        $address = $this->getLoggedInAddress();
        $frontendUser = $this->getLoggedInFrontendUser();
        if(is_null($frontendUser)){
            if($this->settings['pidsLogin']) {
                return $this->redirectToUri($this->buildPageLink($this->settings['pidsLogin'], TRUE));
            } else {
                throw new Exception('PidLogin not set. Cannot redirect.', '1508229013');
            }
        }
        if (is_null($address)) {
            if ($this->settings['createDefaultAddressType'] !== '') {
                $address = $this->createAddressFromFeUser($this->settings['createDefaultAddressType']);
                $this->addressRepository->add($address);
                $this->persistenceManager->persistAll();
                $this->view->assign('address', $address);
            } else {
                $this->view->assign('feUser', $this->getLoggedInFrontendUser());
                $this->view->assign('types', Address::getTypeConstants());
            }
        } else {
            $this->view->assign('address', $this->getLoggedInAddress());
        }
        return $this->htmlResponse();
    }

    /**
     *
     * @param string $type
     * @throws InvalidArgumentTypeException
     * @throws Exception
     */
    public function newAction(string $type): ResponseInterface
    {
        $address = $this->createAddressFromFeUser($type);
        $this->assignEditableCategories();
        $this->view->assign('address', $address);
        return $this->htmlResponse();

    }

    public function editAction(Address $address): ResponseInterface
    {
        $this->assignEditableCategories();
        $this->view->assign('address', $address);
        return $this->htmlResponse();
    }

    /**
     * @throws Exception
     * @throws StopActionException
     * @throws IllegalObjectTypeException
     * @throws TooDirtyException
     */
    public function createAction(Address $address): ResponseInterface
    {
        $this->addressService->updateCoordinates($address);
        $this->addressRepository->add($address);
        $this->addFlashMessage($this->localize('flashMessage.created'),AbstractMessage::OK);
        return $this->redirect('dash');
    }

    /**
     * @throws StopActionException
     * @throws UnknownObjectException
     * @throws IllegalObjectTypeException
     * @throws TooDirtyException
     */
    public function updateAction(Address $address): ResponseInterface
    {
        $this->addressService->updateCoordinates($address);
        $this->addressRepository->update($address);
        $this->addFlashMessage($this->localize('flashMessage.updated'),AbstractMessage::OK);
        return $this->redirect('dash');
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction(): ResponseInterface
    {
        $orderings = null;
        $addresses = null;
        if ($this->settings['orderBy'] && $this->settings['orderDirection']) {
            $orderings = array($this->settings['orderBy'] => $this->settings['orderDirection']);
        }
        if ($this->settings['listType'] === 'all') {
            /** @noinspection TypeUnsafeComparisonInspection */
            if($this->settings['category'] != '' || $this->settings['publishState']){
                $addresses = $this->addressRepository->findDemanded(
                    null,
                    GeneralUtility::intExplode(',', $this->settings['category'],true),
                    $this->settings['publishState'],
                    $orderings
                );
            }else{
                $addresses = $this->addressRepository->findDemanded(null,null,null, $orderings);
            }

        }

        if ($this->settings['listType'] === 'manual' && $this->settings['addresses']) {
            $addresses = $this->addressRepository->findDemanded(GeneralUtility::intExplode(',',$this->settings['addresses']), null, null, $orderings);
        }

        if ($this->settings['filterConfiguration']) {
            $filters = [];
            foreach ($this->settings['filterConfiguration'] as $key => $filter) {
                /** @var Category $parent */
                $parent = $this->categoryRepository->findByUid($filter['rootCategory']);
                if ($parent) {
                    $sorting = array($filter['orderBy'] => $filter['sorting']);
                    $filterCategories = $this->categoryService->findAllDescendants($parent, $sorting);
                    $filters[$key] = $filterCategories;
                }
            }
            $this->view->assign('filters', $filters);
        }

        $this->view->assign('addresses', $addresses);
        $this->view->assign('contentUid', $this->configurationManager->getContentObject()->data['uid']);
        return $this->htmlResponse();
    }


    /**
     * action show
     *
     * @param Address $address
     * @return void
     */
    public function showAction(Address $address): ResponseInterface
    {
        $this->view->assign('address', $address);
        $this->view->assign('contentUid', $this->configurationManager->getContentObject()->data['uid']);
        return $this->htmlResponse();
    }

    /**
     *
     * @throws \UnexpectedValueException
     * @throws Exception
     */
    protected function getLoggedInAddress()
    {
        $frontendUser = $this->getLoggedInFrontendUser();
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->addressRepository->findOneByFeUser($frontendUser);
    }

    /**
     * creates an new speaker
     * @param string
     * @return Address
     * @throws InvalidArgumentTypeException
     * @throws Exception
     */
    protected function createAddressFromFeUser($type)
    {
        $frontendUser = $this->getLoggedInFrontendUser();
        if ($type === AddressInterface::PERSON) {
            /** @var Address\Person $address */
            /** @noinspection PhpDeprecationInspection */
            $address = $this->objectManager->get(Person::class);
            $address->setName($frontendUser->getLastName());
            $address->setFirstName($frontendUser->getFirstName());
            $address->setEmail($frontendUser->getEmail());
            $address->setType(AddressInterface::PERSON);
        } elseif ($type === AddressInterface::ORGANISATION) {
            /** @var Address\Organisation $address */
            /** @noinspection PhpDeprecationInspection */
            $address = $this->objectManager->get(Organisation::class);
            $address->setType(AddressInterface::ORGANISATION);
        } elseif ($type === AddressInterface::LOCATION) {
            /** @var Address\Location $address */
            /** @noinspection PhpDeprecationInspection */
            $address = $this->objectManager->get(Location::class);
            $address->setType(AddressInterface::LOCATION);
        } else {
            throw new InvalidArgumentTypeException($type . " is no correct address type", 1488302381);
        }
        $address->setFeUser($frontendUser);

        return $address;
    }

    protected function assignEditableCategories(): void
    {
        $editableCategories = [];
        if ($this->settings['editableCategoryConfiguration']) {
            foreach ($this->settings['editableCategoryConfiguration'] as $key => $value) {
                /** @noinspection PhpParamsInspection */
                $categories = $this->categoryService->findAllDescendants(
                    $this->categoryRepository->findByUid($value['rootCategory']),
                    [$value['orderBy'] => $value['sorting']]
                );
                $editableCategories[$key] = [
                    'categories' => $categories,
                    'configuration' => $value,
                ];
            }
        }
        $this->view->assign('editableCategories', $editableCategories);
    }

}
