<?php
namespace Undkonsorten\Addressmgmt\Controller;

use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use Undkonsorten\Addressmgmt\Domain\Model\Address;
use Undkonsorten\Addressmgmt\Domain\Model\File\FileMetaData;
use Undkonsorten\Addressmgmt\Domain\Model\File\FileUpload;
use Undkonsorten\Addressmgmt\Domain\Repository\AddressRepository;
use Undkonsorten\Addressmgmt\File\ResourceFactory;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 "Eike Starkmann <starkmann@undkonsorten.com>"
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
 * @TODO +++ IMPORTANT: Try to move to fluid widget?
 *
 * @package address
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FileController extends BaseController {

    /**
     * @var StorageRepository
     */
    protected $storageRepository;

    public function injectStorageRepository(StorageRepository $storageRepository): void
    {
        $this->storageRepository = $storageRepository;
    }

    /**
     * @var FileRepository
     */
    protected $fileRepository;

    public function injectFileRepository(FileRepository $fileRepository): void
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @var ResourceFactory
     */
    protected $resourceFactory;

    public function injectResourceFactory(ResourceFactory $resourceFactory): void
    {
        $this->resourceFactory = $resourceFactory;
    }

    /**
     * @var AddressRepository
     */
    protected $addressRepository;

    public function injectAddressRepository(AddressRepository $addressRepository): void
    {
        $this->addressRepository = $addressRepository;
    }


    /**
  * Add a new File
  *
  * @param Address $address
  * @param \string $property
  * @param FileReference $fileReference
  *
  */
 #[IgnoreValidation(['value' => '$address'])]
 public function newAction(Address $address, $property, FileUpload $fileUpload = NULL, FileReference $fileReference = NULL): ResponseInterface{
		if(is_null($fileUpload)) {
			$fileUpload = $this->objectManager->get(FileUpload::class);
			if ('image' == $property) {
				$fileUpload->getFileMetaData()->setAlternative($address->getFullName());
			}
			if(!is_null($fileReference)) {
				$this->resourceFactory->updateFileMetaDataFromFileReference($fileUpload->getFileMetaData(), $fileReference);	
			}
		}
		
		$this->view->assign('fileUpload', $fileUpload);
		$this->view->assign('address', $address);
		$this->view->assign('property', $property);
		$this->view->assign('propertyUpload', $property."Upload");
		$this->view->assign('fileReference', $fileReference);
  return $this->htmlResponse();
	}
	
	/**
  * Update an existing File
  *
  * @param Address $address
  * @param FileReference $fileReference
  * @param \string $property
  * @param FileMetaData $fileMetaData
  *
  */
 #[IgnoreValidation(['value' => '$address'])]
 public function editAction(Address $address, FileReference $fileReference, $property, FileMetaData $fileMetaData = NULL): ResponseInterface{
		if(is_null($fileMetaData)) {
			$fileMetaData = $this->objectManager->get(FileMetaData::class);
			if(!is_null($fileReference)) {
				$this->resourceFactory->updateFileMetaDataFromFileReference($fileMetaData, $fileReference);
			}
		}
		$this->view->assign('fileMetaData', $fileMetaData);
		$this->view->assign('address', $address);
		$this->view->assign('property', $property);
		$this->view->assign('fileReference', $fileReference);
  return $this->htmlResponse();
	}
	
	/**
	 *
	 * @param Address $address
	 * @param FileMetaData $fileMetaData
	 * @param FileReference $fileReference
	 */
	public function updateAction(Address $address, FileMetaData $fileMetaData = NULL, FileReference $fileReference = NULL){
		$file = $fileReference->getOriginalResource()->getOriginalFile();
		$this->resourceFactory->updateFileWithMetaData($file, $fileMetaData);
		$this->redirect('dash','Address');
	}

	/**
	 *
	 * @param FileReference $fileReference
	 * @param \string $property
	 * @param  \sting $propertyUpload
	 * @param Address $address
	 */
	public function createAction(Address $address, $property, FileReference $fileReference = NULL){

		//@TODO get from TS settigns settings.target.$property '1:user_upload'
		if(isset($this->settings['target'][$property])) {
			$target = $this->settings['target'][$property];
		} elseif (isset($this->settings['target']['default'])) {
			$target = $this->settings['target']['default'];
		} else {
			throw new \UnexpectedValueException('No target given', 1384353485);
		}

		$propertyUpload = $property."Upload";

		if(!ObjectAccess::isPropertyGettable($address, $propertyUpload)) {
			throw new \Exception('cant find upload property ' . $propertyUpload);
		}
		$fileUpload = ObjectAccess::getProperty($address, $propertyUpload);
		
		if(!is_null($fileReference)){
			$fileReference = $this->resourceFactory->replaceFileReferenceByUploadedFile($fileUpload, $target, $fileReference, $address, $property);
		} else {
			$fileReference = $this->resourceFactory->uploadAndReferenceFile($fileUpload, $target, $address, $property);
		}

		$this->addFlashMessage(LocalizationUtility::translate('flashMessage.createFile', 'Addressmgmt', array(0=>htmlspecialchars($fileUpload->getName()))));
		$this->redirect('dash','Address');
	
	}
	/**
	 *
	 * @param FileReference $fileReference
	 */
	public function deleteAction(FileReference $fileReference){
		$this->resourceFactory->deleteFileReference($fileReference);
		$this->addFlashMessage(LocalizationUtility::translate('flashMessage.deleteFile', 'Addressmgmt', array(0=>$fileReference->getUid())));
		$this->redirect('dash','Address');
	}
	
	protected function getErrorFlashMessage(){
		$message = array();
		foreach ($this->arguments->validate()->getFlattenedErrors() as $propertyPath => $errors) {
				foreach ($errors as $error) {
					$message .= 'Error for ' . $propertyPath . ':  ' . $error->render() . PHP_EOL;
				}
		}
		return $message;
	}
		

}
