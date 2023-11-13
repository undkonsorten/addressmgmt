<?php
namespace Undkonsorten\Addressmgmt\Domain\Repository;

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
 * @package addressmgmt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Core\Database\ReferenceIndex;
use TYPO3\CMS\Core\Resource\FileRepository as FileRepositoryAlias;
use TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbBackend;
use TYPO3\CMS\Extbase\Property\PropertyMapper;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class FileReferenceRepository {
	
	/**
	 * type returned by this repository
	 * @var \string
	 */
	protected $type = FileReference::class;

    /**
     * @var FileRepositoryAlias
     */
    protected $fileRepository;

    public function injectFileRepository(FileRepositoryAlias $fileRepository): void
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @var Typo3DbBackend
     */
    protected $typo3DbBackend;

    public function injectTypo3DbBackend(Typo3DbBackend $typo3DbBackend): void
    {
        $this->typo3DbBackend = $typo3DbBackend;
    }

    /**
     * @var ReferenceIndex
     */
    protected $referenceIndex;

    public function injectReferenceIndex(ReferenceIndex $referenceIndex): void
    {
        $this->referenceIndex = $referenceIndex;
    }

    /**
     * @var PropertyMapper
     */
    protected $propertyMapper;

    public function injectPropertyMapper(PropertyMapper $propertyMapper): void
    {
        $this->propertyMapper = $propertyMapper;
    }

    /**
  * add method isn't implemented, use resourceFactory instead
  *
  * @param FileReference $fileReference
  * @throws \BadMethodCallException
  */
 public function add(FileReference $fileReference) {
		throw new \BadMethodCallException('Use resourceFactory to add file reference', 1383231125);
	}
	
	/**
  * adds a new file reference from raw data
  *
  * @param \integer $uidLocal
  * @param \string $tableName
  * @param \string $fieldName
  * @param \integer $uidForeign
  * @param \integer $pid
  * @param \integer $count
  * @return FileReference
  */
 public function addRaw($uidLocal, $tableName, $fieldName, $uidForeign, $pid, $count) {
		$fileReference = $this->addInternal($uidLocal, $tableName, $fieldName, $uidForeign, $pid);
		$updateRow = array(
			'uid' => $uidForeign,
			$fieldName => $count + 1,
		);
		$this->typo3DbBackend->updateRow($tableName, $updateRow, TRUE);
		$this->referenceIndex->updateRefIndexTable($tableName, $uidForeign);
		return $fileReference;
	}
	
	/**
  * updates a file reference
  *
  * @param File $file
  * @param FileReference $fileReference
  * @return void
  */
 public function updateFileInFileReference(File $file, FileReference $fileReference, $tableName, $fieldName, $uidForeign, $pid) {
		$this->deleteInternal($fileReference);
		return $this->addInternal($file->getUid(), $tableName, $fieldName, $uidForeign, $pid);
	}
	
	/**
  * deletes a file reference
  *
  * @param FileReference $fileReference
  * @return void
  */
 public function delete(FileReference $fileReference) {
		$properties = $fileReference->getOriginalResource()->getProperties();
		$fileReferences = $this->fileRepository->findByRelation($properties['tablenames'], $properties['fieldname'], $properties['uid_foreign']);
		$count = count($fileReferences);
		$this->deleteInternal($fileReference);
		$row = array(
			'uid' => $properties['uid_foreign'],
			$properties['fieldname'] => $count-1,
		);
		$this->typo3DbBackend->updateRow($properties['tablenames'], $row);
		$this->referenceIndex->updateRefIndexTable($properties['tablenames'], $properties['uid_foreign']);
	}
	
	/**
  * finds a file reference by uid 
  *
  * @param \integer $uid
  * @return FileReference
  */
 public function findByUid($uid) {
		// @TODO implement
	}
	
	/**
  * finds all file references for given object/property
  *
  * @param \mixed $object
  * @param \string $property
  * @return ObjectStorage<FileReference>
  */
 public function findByForeignObject($object, $property) {
		//@TODO implement
	}
	
	/**
  * finds one file reference for given object/property
  *
  * @param \mixed $object
  * @param \string $property
  * @return FileReference
  */
 public function findOneByForeignObject($object, $property) {
		$fileReferences = $this->findByForeignObject($object, $property);
		if(!is_null($fileReferences) && $fileReferences->count()) {
			return $fileReferences->current();
		}
	}
	
	/**
  * finds all file references for given file
  *
  * @param File $file
  * @return ObjectStorage<FileReference>
  */
 public function findByFile(File $file) {
		//@TODO implement
	}

	/**
  * Adds a file reference with given relations
  *
  * @param \integer $uidLocal
  * @param \string $tableName
  * @param \string $fieldName
  * @param \integer $uidForeign
  * @param \integer $pid
  * @return FileReference
  */
 protected function addInternal($uidLocal, $tableName, $fieldName, $uidForeign, $pid) {
		$insertRow = array(
				'uid_local' => $uidLocal,
				'tstamp' => time(),
				'crdate' => time(),
				'uid_foreign' => $uidForeign,
				'fieldname' => $fieldName,
				'pid' => $pid,
				'tablenames' => $tableName,
				'table_local' => 'sys_file',
		);
		$uid = $this->typo3DbBackend->addRow('sys_file_reference', $insertRow);
		$this->referenceIndex->updateRefIndexTable('sys_file_reference', $uid);
		return $this->propertyMapper->convert($uid, $this->type);
		// return $this->fileRepository->findFileReferenceByUid($uid);
	}
	
	/**
  * Deletes a file reference from database
  *
  * @param FileReference $fileReference
  */
 protected function deleteInternal(FileReference $fileReference) {
		$uid = $fileReference->getOriginalResource()->getUid();
		$row = array(
			'uid' => $uid,
			'deleted' => 1,
		);
		$this->typo3DbBackend->updateRow('sys_file_reference', $row);
		$this->referenceIndex->updateRefIndexTable('sys_file_reference', $uid);
	}
	
	
}
?>
