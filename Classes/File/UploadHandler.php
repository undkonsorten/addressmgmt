<?php
namespace Undkonsorten\Addressmgmt\File;

use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMap;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\ColumnMap;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\ResourceFactory as ResourceFactoryAlias;
use TYPO3\CMS\Core\Utility\File\BasicFileUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapFactory;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Eike Starkmann <starkmann@undkonsorten.com>, undkonsorten
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
 * @package speaker
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class UploadHandler {

	/**
	 * 
	 * @var mixed
	 */
	protected $object;
	
	/**
	 * Name of the property
	 * 
	 * @var \string
	 */
	protected $property;
	
	/**
  * The datamap
  *
  * @var DataMap
  */
 protected $dataMap;
	
	/**
  * Storage for upload
  *
  * @var ResourceStorage
  */
 protected $storage;
	
	/**
  * Folder for upload
  *
  * @var Folder
  */
 protected $folder;

    /**
     * @var DataMapper
     */
    protected $dataMapper;

    public function injectDataMapper(DataMapper $dataMapper): void
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * @var DataMapFactory
     */
    protected $dataMapFactory;

    public function injectDataMapFactory(DataMapFactory $dataMapFactory): void
    {
        $this->dataMapFactory = $dataMapFactory;
    }

    /**
     * @var BasicFileUtility
     */
    protected $basicFileUtility;

    public function injectBasicFileUtility(BasicFileUtility $basicFileUtility): void
    {
        $this->basicFileUtility = $basicFileUtility;
    }

    /**
     * @var ResourceFactoryAlias
     */
    protected $resouFactory;

    public function injectResourceFactory(ResourceFactoryAlias $resourceFactory): void
    {
        $this->resourceFactory = $resourceFactory;
    }

    /**
	 * Builds datamap once object and property are given
	 * 
	 * @return void
	 */
	public function buildDataMap() {
		$this->dataMap = $this->dataMapFactory->buildDataMap(get_class($this->object));
	}
	
	/**
	 * checks if relation is single-valued
	 * 
	 * @throws \UnexpectedValueException
	 * @return boolean
	 */
	public function upperLimitOfMultiplicityEqualsOne() {
		if(!$this->dataMap->getColumnMap($this->property)) {
			throw new \UnexpectedValueException('Unknown property ' . get_class($object) . '->' . $this->property, 1383123581);
		} 
		return $this->dataMap->getColumnMap($this->property)->getTypeOfRelation() == ColumnMap::RELATION_HAS_ONE;
	}
	
	/**
	 * 
	 * @param \TYPO3\CMS\Core\Resource\RecourceStorage $storage
	 * @param \string $temporaryFile
	 * @param \array $fileProperties
	 */
	public function uploadFile(array $uploadedFileData, $fileProperties) {
		if(is_null($this->getStorage())) {
			throw new \Exception('No storage given', 1383133292);
		}
		$file = $this->getStorage()->addUploadedFile($uploadedFileData, NULL, NULL, 'replace');
		return $file;
	}
	
	/**
  * creates the file reference
  *
  * @param \TYPO3\CMS\Core\Resource\ $file
  * @param integer $pid
  * @return FileReference
  */
 public function createFileReference(File $file, $pid = NULL) {
		if(is_null($pid)) {
			// @TODO get pid from object
			throw new \UnexpectedValueException('pid has to be integer', 1383134497);
		}
		$tableNames = $this->dataMap->getTableName();
		$fieldName = $this->dataMap->getColumnMap($this->property)->getColumnName();
		$uidForeign = $this->object->getUid();
		$data = array();
		$data['sys_file_reference']['NEW1234'] = array(
				'uid_local' => $file->getUid(),
				'uid_foreign' => $uidForeign, 
				'tablenames' => $tableNames,
				'fieldname' => $fieldName,
				'pid' => $pid, // parent id of the parent page
				'table_local' => 'sys_file',
		);
		$data[$tableNames][$uidForeign] = array($fieldName => '1'); // set to the number of images?
	
		/* @var $tce \TYPO3\CMS\Core\DataHandling\DataHandler */
		$tce = GeneralUtility::makeInstance('TYPO3\CMS\Core\DataHandling\DataHandler'); // create TCE instance
		$tce->stripslashes_values = 0;
		$tce->enableLogging = FALSE;
		$tce->start($data, array());
		$tce->process_datamap();
		if ($tce->errorLog) DebuggerUtility::var_dump($tce->errorLog);
		DebuggerUtility::var_dump($file);
		$uid = $tce->substNEWwithIDs['NEW1234'];
		return $this->resourceFactory->getFileReferenceObject($uid);
	}
	
	/**
	 * Checks if file is set and returns the temporary path
	 * 
	 * @param \string $namespace
	 * @param \string $name
	 * @param \string $property
	 */
	public function checkFileUpload($namespace, $name, $property){
		if ($_FILES[$namespace]) {
			return $_FILES[$namespace]['tmp_name'][$name][$property];
		}
	}
	
	/**
	 * Adds the file to a storage
	 *
	 * @param \TYPO3\CMS\Core\Resource\RecourceStorage $storage
	 * @param \string $tempFile
	 * @param \string $fileName
	 * @rerturn \TYPO3\CMS\Core\Resource\FileInterface $fileObject
	 */
	protected function addFileToStorage($storage, $tempFile, $fileName){
		$fileObject = $storage->addFile($tempFile, $storage->getRootLevelFolder(), $fileName);
		return $fileObject;
	}
	
	/**
  * Creates the file reference
  * @param FileInterface $file
  * @param mixed $foreignObject
  * @param \string $foreignField
  * @param \integer $pid
  * @param \string $foreignTable
  */
 public function createLocalFileReference(FileInterface $file, $foreignObject, $foreignField, $pid = 13, $foreignTable = ''){
	
		if(!$foreignTable){
			$foreignTable = $this->dataMapper->convertClassNameToTableName(get_class($foreignObject));
		}
	
		$data = array();
		$data['sys_file_reference']['NEW1234'] = array(
				'uid_local' => $file->getUid(),
				'uid_foreign' => $foreignObject->getUid(), // uid of your content record
				'tablenames' => $foreignTable,
				'fieldname' => $foreignField,
				'pid' => $pid, // parent id of the parent page
				'table_local' => 'sys_file',
		);
		$data[$foreignTable][$foreignObject->getUid()] = array($foreignField => 'NEW1234'); // set to the number of images?
	
		$tce = GeneralUtility::makeInstance('TYPO3\CMS\Core\DataHandling\DataHandler'); // create TCE instance
		$tce->start($data, array(), $new_BE_USER);
		$tce->process_datamap();
		if ($tce->errorLog) DebuggerUtility::var_dump($tce->errorLog);
	}
	
	/**
	 * Gets the object
	 * 
	 * @return \mixed
	 */
	public function getObject() {
		return $this->object;
	}
	
	/**
	 * Sets the object
	 * 
	 * @param \mixed $object
	 */
	public function setObject($object) {
		$this->object = $object;
	}

	/**
	 * Gets the name of property
	 * 
	 * @return string
	 */
	public function getProperty() {
		return $this->property;
	}
	
	/**
	 * Sets the name of property
	 * 
	 * @param string $property
	 */
	public function setProperty($property) {
		$this->property = $property;
	}
	
	/**
  * Gets the storage
  *
  * @return ResourceStorage
  */
 public function getStorage() {
		return $this->storage;
	}
	
	/**
  * Sets the storage
  *
  * @param ResourceStorage $storage
  * @return void
  */
 public function setStorage(ResourceStorage $storage) {
		$this->storage = $storage;
	}
	
	/**
  * Gets the folder
  *
  * @return Folder
  */
 public function getFolder() {
		return $this->folder;
	}
	
	/**
  * Sets the folder
  *
  * @param Folder $folder
  * @return void
  */
 public function setFolder(Folder $folder) {
		$this->folder = $folder;
	}

}
?>
