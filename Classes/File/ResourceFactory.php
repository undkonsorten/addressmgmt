<?php

namespace Undkonsorten\Addressmgmt\File;

use Exception;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapFactory;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;
use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use Undkonsorten\Addressmgmt\Domain\Model\File\FileMetaData;
use Undkonsorten\Addressmgmt\Domain\Model\File\FileUpload;
use Undkonsorten\Addressmgmt\Domain\Repository\FileReferenceRepository;
use UnexpectedValueException;


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
 * @package addressmgmz
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ResourceFactory implements SingletonInterface
{

    /**
     * @var ObjectManager
     */
    protected $objectManager;
    /**
     * @var DataMapFactory
     */
    protected $dataMapFactory;
    /**
     * @var FileReferenceRepository
     */
    protected $fileReferenceRepository;
    /**
     * @var FileRepository
     */
    protected $fileRepository;
    /**
     * @var DataMapper
     */
    protected $dataMapper;
    /**
     * @var StorageRepository
     */
    protected $storageRepository;

    /**
     * Gets a singleton instance of this class.
     *
     * @return ResourceFactory
     */
    static public function getInstance()
    {
        $objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        return $objectManager->get(__CLASS__);
    }

    public function injectObjectManager(ObjectManager $objectManager): void
    {
        $this->objectManager = $objectManager;
    }

    public function injectDataMapFactory(DataMapFactory $dataMapFactory): void
    {
        $this->dataMapFactory = $dataMapFactory;
    }

    public function injectFileReferenceRepository(FileReferenceRepository $fileReferenceRepository): void
    {
        $this->fileReferenceRepository = $fileReferenceRepository;
    }

    public function injectFileRepository(FileRepository $fileRepository): void
    {
        $this->fileRepository = $fileRepository;
    }

    public function injectDataMapper(DataMapper $dataMapper): void
    {
        $this->dataMapper = $dataMapper;
    }

    public function injectStorageRepository(StorageRepository $storageRepository): void
    {
        $this->storageRepository = $storageRepository;
    }

    /**
     * Upload a file and create reference
     *
     * @param FileUpload $fileUpload
     * @param ResourceStorage|Folder|string $target
     * @param mixed $object
     * @param string $property
     * @param integer $pid
     * @return FileReference
     * @throws Exception
     */
    public function uploadAndReferenceFile(FileUpload $fileUpload, $target, $object, $property, $pid = NULL)
    {
        $folder = $this->getFolderFromTarget($target);
        $file = $this->createFileFromUpload($fileUpload, $folder);
        if ($file) {
            $fileReference = $this->createFileReference($file, $object, $property, $pid);
        } else {
            throw new Exception('Could not create file', 1383233402);
        }
        return $fileReference;
    }

    /**
     * @param $target
     * @return Folder|\TYPO3\CMS\Core\Resource\InaccessibleFolder
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    protected function getFolderFromTarget($target)
    {
        if (is_null($target)) {
            throw new UnexpectedValueException('No target given', 1383226457);
        }
        if (is_a($target, 'TYPO3\CMS\Core\Resource\ResourceStorage')) {
            /* @var $storage ResourceStorage */
            $storage = $target;
            $folder = $storage->getDefaultFolder();
        } elseif (is_a($target, 'TYPO3\CMS\Core\Resource\Folder')) {
            $folder = $target;
        } elseif (is_string($target)) {
            $array = explode(":", $target);
            if (!is_int((int)$array[0])) throw new UnexpectedValueException('Unexpected format ' . $target . ' Expecting "storage(int):folder(string)"', 1384358666);

            $storage = $this->storageRepository->findByUid($array[0]);

            if (is_null($storage)) throw new UnexpectedValueException('Storage ' . $array[0] . ' not found.', 1384358679);

            if (!is_null($array[1])) {
                if ($storage->hasFolder($array[1])) {
                    $folder = $storage->getFolder($array[1]);
                } else {
                    throw new UnexpectedValueException('Folder "' . $array[1] . '" does not exist', 1384358690);
                }
            } else {
                $folder = $storage->getDefaultFolder();
            }
        } else {
            throw new UnexpectedValueException('Unexpected type ' . get_class($target) . ' for $target', 1384358704);
        }
        return $folder;
    }

    /**
     * @param FileUpload $fileUpload
     * @param Folder $folder
     * @param string $conflictMode
     * @return File|\TYPO3\CMS\Core\Resource\FileInterface
     * @throws \TYPO3\CMS\Extbase\Reflection\Exception\PropertyNotAccessibleException
     */
    protected function createFileFromUpload(FileUpload $fileUpload, Folder $folder, $conflictMode = 'rename')
    {
        $file = $folder->getStorage()->addUploadedFile($fileUpload->getFileUploadArray(), $folder, NULL, $conflictMode);
        $this->updateFileWithMetaData($file, $fileUpload->getFileMetaData());
        return $file;
    }

    /**
     * @param File $file
     * @param FileMetaData $fileMetaData
     * @throws \TYPO3\CMS\Extbase\Reflection\Exception\PropertyNotAccessibleException
     */
    public function updateFileWithMetaData(File $file, FileMetaData $fileMetaData)
    {
        $propertiesToBeUpdated = array(
            'title',
            'alternative',
            'link',
            'description',
        );
        $metaData = $file->getMetaData();
        foreach ($propertiesToBeUpdated as $property) {
            $value = ObjectAccess::getProperty($fileMetaData, $property);
            $metaData->offsetSet($property, $value);
        }
        $metaData->save();
    }

    /**
     * @param File $file
     * @param $object
     * @param $property
     * @param null $pid
     * @return FileReference
     * @throws \TYPO3\CMS\Extbase\Reflection\Exception\PropertyNotAccessibleException
     */
    protected function createFileReference(File $file, $object, $property, $pid = NULL)
    {
        $dataMap = $this->dataMapFactory->buildDataMap(get_class($object));
        $uidLocal = $file->getUid();
        $foreignParameters = $this->getForeignParameters($object, $property);
        if (!is_numeric($pid)) {
            $pid = ObjectAccess::getProperty($object, 'pid');
            if (!is_numeric($pid)) {
                throw new InvalidArgumentException('No pid given', 1383735988);
            }
        }
        $count = $this->dataMapper->countRelated($object, $property);
        $fileReference = $this->fileReferenceRepository->addRaw($uidLocal, $foreignParameters['tablenames'], $foreignParameters['fieldname'], $foreignParameters['uid_foreign'], $pid, $count);
        return $fileReference;
    }

    /**
     * @param $object
     * @param $property
     * @return array
     * @throws \TYPO3\CMS\Extbase\Reflection\Exception\PropertyNotAccessibleException
     */
    protected function getForeignParameters($object, $property)
    {
        $dataMap = $this->dataMapFactory->buildDataMap(get_class($object));
        $tableName = $dataMap->getTableName();
        $fieldName = $dataMap->getColumnMap($property)->getColumnName();
        $uidForeign = ObjectAccess::getProperty($object, 'uid');
        return array('tablenames' => $tableName, 'uid_foreign' => $uidForeign, 'fieldname' => $fieldName);
    }

    /**
     *
     * @TODO implement deleteFileIfPossible
     * @param FileReference $fileReference
     * @param mixed $object
     * @param string $property
     * @param boolean $deleteFileIfPossible
     */
    public function deleteFileReference(FileReference $fileReference)
    {
        $this->fileReferenceRepository->delete($fileReference);
    }

    /**
     * @param FileUpload $fileUpload
     * @param $target
     * @param FileReference $fileReference
     * @param $object
     * @param $property
     * @return FileReference|void
     */
    public function replaceFileReferenceByUploadedFile(FileUpload $fileUpload, $target, FileReference $fileReference, $object, $property)
    {
        $folder = $this->getFolderFromTarget($target);
        $file = $this->createFileFromUpload($fileUpload, $folder);
        if ($file) {
            $uidLocal = $file->getUid();
            $foreignParameters = $this->getForeignParameters($object, $property);
            $pid = $object->getPid();
            $fileReference = $this->fileReferenceRepository->updateFileInFileReference($file, $fileReference, $foreignParameters['tablenames'], $foreignParameters['fieldname'], $foreignParameters['uid_foreign'], $pid);
        }
        return $fileReference;
    }

    /**
     * @param FileMetaData $fileMetaData
     * @param FileReference $fileReference
     * @throws \TYPO3\CMS\Extbase\Reflection\Exception\PropertyNotAccessibleException
     */
    public function updateFileMetaDataFromFileReference(FileMetaData $fileMetaData, FileReference $fileReference)
    {
        $propertiesToBeUpdated = array(
            'title',
            'alternative',
            'link',
            'description',
        );
        foreach ($propertiesToBeUpdated as $property) {
            $value = ObjectAccess::getProperty($fileReference->getOriginalResource(), $property);
            ObjectAccess::setProperty($fileMetaData, $property, $value);
        }
    }
}
