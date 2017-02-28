<?php
namespace Undkonsorten\Addressmgmt\Controller;

use Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt;

use Undkonsorten\Addressmgmt\Domain\Validator\AddressmgmtValidator;

use TYPO3\CMS\Extbase\Reflection\ObjectAccess;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
 * @package speaker
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FileController extends BaseController {
	
	/**
	 * storageRepository
	 *
	 * @var \TYPO3\CMS\Core\Resource\StorageRepository
	 * @inject
	 */
	protected $storageRepository;

	/**
	 * fileRepository
	 * @var TYPO3\CMS\Core\Resource\FileRepository
	 * @inject
	 */
	protected $fileRepository;
	
	/**
	 * @var \Undkonsorten\Addressmgmt\File\ResourceFactory
	 * @inject
	 */
	protected $resourceFactory;
	
	/**
	 * Add a new File
	 *
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker
	 * @param \string $property
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference
	 * @dontvalidate $speaker
	 * @ignorevalidation $speaker
	 * 
	 */
	public function newFileAction(\Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker, $property, \Undkonsorten\Addressmgmt\Domain\Model\File\FileUpload $fileUpload = NULL, \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference = NULL){
		if(is_null($fileUpload)) {
			$fileUpload = $this->objectManager->get('Undkonsorten\Addressmgmt\Domain\Model\File\FileUpload');
			if ('image' == $property) {
				$fileUpload->getFileMetaData()->setAlternative($speaker->getFullName());
			}
			if(!is_null($fileReference)) {
				$this->resourceFactory->updateFileMetaDataFromFileReference($fileUpload->getFileMetaData(), $fileReference);	
			}
		}
		
		$this->view->assign('fileUpload', $fileUpload);
		$this->view->assign('speaker', $speaker);
		$this->view->assign('property', $property);
		$this->view->assign('propertyUpload', $property."Upload");
		$this->view->assign('fileReference', $fileReference);
	}
	
	/**
	 * Update an existing File
	 *
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference
	 * @param \string $property
	 * @dontvalidate $speaker
	 * @ignorevalidation $speaker
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\File\FileMetaData $fileMetaData
	 * 
	 */
	public function editFileAction(\Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker, \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference, $property, \Undkonsorten\Addressmgmt\Domain\Model\File\FileMetaData $fileMetaData = NULL){
		if(is_null($fileMetaData)) {
			$fileMetaData = $this->objectManager->get('Undkonsorten\Addressmgmt\Domain\Model\File\FileMetaData');
			if(!is_null($fileReference)) {
				$this->resourceFactory->updateFileMetaDataFromFileReference($fileMetaData, $fileReference);
			}
		}
		$this->view->assign('fileMetaData', $fileMetaData);
		$this->view->assign('speaker', $speaker);
		$this->view->assign('property', $property);
		$this->view->assign('fileReference', $fileReference);
	}
	
	/**
	 *
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\File\FileMetaData $fileMetaData
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference
	 */
	public function updateFileAction(\Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker, \Undkonsorten\Addressmgmt\Domain\Model\File\FileMetaData $fileMetaData = NULL, \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference = NULL){
		$file = $fileReference->getOriginalResource()->getOriginalFile();
		$this->resourceFactory->updateFileWithMetaData($file, $fileMetaData);
		$this->redirect('showProfile','Addressmgmt');
	}
	
	/**
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference
	 * @param \string $property
	 * @param  \sting $propertyUpload
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker
	 */
	public function createFileAction(\Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker, $property, \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference = NULL){
		//@TODO get from TS settigns settings.target.$property '1:user_upload'
		if(isset($this->settings['target'][$property])) {
			$target = $this->settings['target'][$property];
		} elseif (isset($this->settings['target']['default'])) {
			$target = $this->settings['target']['default'];
		} else {
			throw new \UnexpectedValueException('No target given', 1384353485);
		}
		if(is_null($propertyUpload)) {
			$propertyUpload = $property."Upload";
		}
		if(!ObjectAccess::isPropertyGettable($speaker, $propertyUpload)) {
			throw new \Exception('cant find upload property ' . $propertyUpload);
		}
		$fileUpload = ObjectAccess::getProperty($speaker, $propertyUpload);
		
		
		if(!is_null($fileReference)){
			
			$fileReference = $this->resourceFactory->replaceFileReferenceByUploadedFile($fileUpload, $target, $fileReference, $speaker, $property);
		} else {
			$fileReference = $this->resourceFactory->uploadAndReferenceFile($fileUpload, $target, $speaker, $property);
		}
		$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('flashMessage.createFile', $this->extensionName, array(0=>htmlspecialchars($fileUpload->getName()))));
		$this->redirect('showProfile','Addressmgmt');
	
	}
	/**
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference
	 */
	public function deleteFileAction(\TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference, \Undkonsorten\Addressmgmt\Domain\Model\Addressmgmt $speaker){
		$this->resourceFactory->deleteFileReference($fileReference, $speaker, 'download');
		$this->flashMessageContainer->add(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('flashMessage.deleteFile', $this->extensionName, array(0=>$fileReference->getUid())));
		$this->redirect('showProfile','Addressmgmt');
	}
	
	protected function getErrorFlashMessage(){ 
		foreach ($this->arguments->getValidationResults()->getFlattenedErrors() as $propertyPath => $errors) {
				foreach ($errors as $error) {
					$message .= 'Error for ' . $propertyPath . ':  ' . $error->render() . PHP_EOL;
				}
		}
		return $message;
	}
		

}
?>
