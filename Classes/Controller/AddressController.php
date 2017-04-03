<?php
namespace Undkonsorten\Addressmgmt\Controller;

use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Undkonsorten\Addressmgmt\Domain\Model\AddressInterface;
use Undkonsorten\Addressmgmt\Domain\Model\Address;
use TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentTypeException;
use Undkonsorten\Addressmgmt\Utility\TemplateLayout;

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
     * addressRepository
     *
     * @var \Undkonsorten\Addressmgmt\Domain\Repository\AddressRepository
     * @inject
     */
    protected $addressRepository;

	/**
	 * categoryRepository
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 *
	 * @var \Undkonsorten\Addressmgmt\Service\CategoryService
	 * @inject
	 */
	protected $categoryService;

    /**
     * @var \Undkonsorten\Addressmgmt\Service\Address
     * @inject
     */
    protected $addressService;

    /**
     * Constructor
     */
    public function initializeAction()
    {
        $this->overrideFlexformSettings();
        $this->storagePidFallback();
        if (isset($this->arguments['address'])) {
            $propertyMappingConfiguration = $this->arguments['address']->getPropertyMappingConfiguration();
            $propertyMappingConfiguration->allowProperties('type');
            $propertyMappingConfiguration->setTypeConverterOption('TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_OVERRIDE_TARGET_TYPE_ALLOWED, TRUE);
        }
    }

    public function handInForReviewAction(Address $address)
    {
        $address->setPublishState(Address::PUBLISH_WAITING);
        $this->addressRepository->update($address);
        $this->addFlashMessage($this->localize('flashMessage.handInForReview'),AbstractMessage::OK);
        $this->redirect('dash');

    }

    public function dashAction()
    {
        $address = $this->getLoggedInAddress();
        //@TODO Security

        if (is_null($address)) {
            if ($this->settings['createDefaultAddressType'] != '') {
                $this->createAddressFromFeUser($this->settings['createDefaultAddressType']);
            } else {
                $this->view->assign('feUser', $this->getLoggedInFrontendUser());
                $this->view->assign('types', Address::getTypeConstants());
            }
        } else {
            $this->view->assign('address', $this->getLoggedInAddress());
        }
    }

    /**
     *
     * @param string $type
     */
    public function newAction($type)
    {
        $address = $this->createAddressFromFeUser($type);
        $this->view->assign('address', $address);

    }

    public function editAction(Address $address)
    {
        if($this->settings['categoryConfiguration']){
             foreach($this->settings['categoryConfiguration'] as $key => $value){
                $categories = $this->categoryService->findAllDescendants(
                    $this->categoryRepository->findByUid($value['rootCategory']),
                    [$value['orderBy'] => $value['sorting']]
                );
                $this->view->assign($key, $categories);
            }

        }

        $this->view->assign('address', $address);
    }

    public function createAction(Address $address)
    {
        $this->addressService->updateCoordinates($address, true);
        if ($this->settings['storeNewAddressNextToFeuser']) {
            $address->setPid($this->getLoggedInFrontendUser()->getPid());
        } else {
            $address->setPid($this->settings['storagePid']);
        }

        $this->addressRepository->add($address);
        $this->addFlashMessage($this->localize('flashMessage.created'),AbstractMessage::OK);
        $this->redirect('dash');
    }

    public function updateAction(Address $address)
    {
        $this->addressService->updateCoordinates($address, true);
        $this->addressRepository->update($address);
        $this->addFlashMessage($this->localize('flashMessage.updated'),AbstractMessage::OK);
        $this->redirect('dash');
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        if ($this->settings['orderBy'] && $this->settings['orderDirection']) {
            $orderings = array($this->settings['orderBy'] => $this->settings['orderDirection']);
        }
        if ($this->settings['listType'] == 'all' && ($this->settings['category'] || $this->settings['publishState'])) {
           $addresses = $this->addressRepository->findDemanded(
                null,
                GeneralUtility::intExplode(',', $this->settings['category'],true),
                $this->settings['publishState'],
                $orderings
            );
        }

        if ($this->settings['listType'] == 'manual' && $this->settings['addresses']) {
            $addresses = $this->addressRepository->findDemanded(GeneralUtility::intExplode(',',$this->settings['addresses']), null, null, $orderings);
        }

        if ($this->settings['filterConfiguration']) {
            foreach ($this->settings['filterConfiguration'] as $key => $filter) {
                $parent = $this->categoryRepository->findByUid($filter['rootCategory']);
                if ($parent) {
                    $sorting = array($filter['orderBy'] => $filter['sorting']);
                    $filterCategories = $this->categoryService->findAllDescendants($parent, $sorting);
                    $this->view->assign($key, $filterCategories);
                }
            }
        }


        $this->view->assign('addresss', $addresses);
        $this->view->assign('contendUid', $this->configurationManager->getContentObject()->data['uid']);
    }


    /**
     * action show
     *
     * @param \Undkonsorten\Addressmgmt\Domain\Model\Address $address
     * @return void
     */
    public function showAction(\Undkonsorten\Addressmgmt\Domain\Model\Address $address)
    {
        $this->view->assign('address', $address);
        $this->view->assign('contendUid', $this->configurationManager->getContentObject()->data['uid']);
    }

    /**
     *
     * @throws \UnexpectedValueException
     */
    protected function getLoggedInAddress()
    {
        $frontendUser = $this->getLoggedInFrontendUser();
        $address = $this->addressRepository->findOneByFeUser($frontendUser);
        return $address;
    }

    /**
     * creates an new speaker
     * @param string
     * @return \Undkonsorten\Addressmgmt\Domain\Model\Address
     */
    protected function createAddressFromFeUser($type)
    {
        $frontendUser = $this->getLoggedInFrontendUser();
        if ($type == AddressInterface::PERSON) {
            $address = $this->objectManager->get('Undkonsorten\Addressmgmt\Domain\Model\Address\Person');
            $address->setName($frontendUser->getLastName());
            $address->setFirstName($frontendUser->getFirstName());
            $address->setEmail($frontendUser->getEmail());
            $address->setType(AddressInterface::PERSON);
        } elseif ($type == AddressInterface::ORGANISATION) {
            $address = $this->objectManager->get('Undkonsorten\Addressmgmt\Domain\Model\Address\Organisation');
            $address->setType(AddressInterface::ORGANISATION);
        } elseif ($type == AddressInterface::LOCATION) {
            $address = $this->objectManager->get('Undkonsorten\Addressmgmt\Domain\Model\Address\Location');
            $address->setType(AddressInterface::LOCATION);
        } else {
            throw new InvalidArgumentTypeException($type . " is no correct address type", 1488302381);
        }

        $address->setFeUser($frontendUser);

        return $address;
    }

}
?>