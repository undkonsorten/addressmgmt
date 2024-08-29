<?php
namespace Undkonsorten\Addressmgmt\Domain\Model\File;

use TYPO3\CMS\Extbase\DomainObject\AbstractValueObject;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Core\Resource\Exception\UploadException;

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
class FileUpload extends AbstractValueObject {

	/**
    * @var FileMetaData
    */
    protected $fileMetaData;

	/**
     * @var \string
     */
    #[Validate(['validator' => 'NotEmpty'])]
    protected $tmp_name;

	/**
	 * @var \string
	 */
	protected $name;

	/**
	 * @var \integer
	 */
	protected $error;

	/**
	 * @var \integer
	 */
	protected $size;

	/**
	 * @var \string
	 */
	protected $type;

	public function __construct() {
		$this->fileMetaData = new FileMetaData;
	}

	public function getFileUploadArray() {
		return array(
			'name' => $this->name,
			'tmp_name' => $this->tmp_name,
			'size' => $this->size,
			'type' => $this->type,
			'error' => $this->error,
		);
	}

	/**
  * gets the meta
  *
  * @return FileMetaData
  */
 public function getFileMetaData() {
		return $this->fileMetaData;
	}

	/**
  * set the file meta data
  *
  * @param FileMetaData $fileMetaData
  */
 public function setFileMetaData(FileMetaData $fileMetaData) {
		$this->fileMetaData = $fileMetaData;
	}

	/**
  * alias to set the file meta data
  *
  * @param FileMetaData $fileMetaData
  */
 public function setMeta(FileMetaData $fileMetaData) {
		$this->setFileMetaData($fileMetaData);
	}


	/**
	 * gets the temporary name
	 *
	 * @return \string
	 */
	public function getTemporaryName() {
		return $this->tmp_name;
	}

	/**
	 * set the temporary name
	 *
	 * @param \string $temporaryName
	 */
	public function setTemporaryName($temporaryName) {
		$this->tmp_name = $temporaryName;
        return $this;
	}

	/**
	 * alias of temporary name
	 *
	 * @param \string $tmpName
	 */
	public function setTmp_name($tmpName) {
        return $this->setTemporaryName($tmpName);
	}

    /**
     * @param $tmpName
     * @return null
     */
    public function setTmpName($tmpName)
    {
        return $this->setTemporaryName($tmpName);
    }

    /**
     * @return string
     */
    public function getTmp_name()
    {
        return $this->getTemporaryName();
    }

    /**
     * @return string
     */
    public function getTmpName()
    {
        return $this->getTemporaryName();
    }



	/**
	 * gets the name
	 *
	 * @return \string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * set the name
	 *
	 * @param \string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * gets the type
	 *
	 * @return \string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * set the type
	 *
	 * @param \string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * gets the error code
	 *
	 * @return \integer
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * sets the error code
	 *
	 * @param \integer $error
	 */
	public function setError($error) {
		$this->error = $error;
	}

	/**
	 * gets the size
	 *
	 * @return \integer
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * sets the size
	 *
	 * @param \integer $size
	 */
	public function setSize($size) {
		$this->size = $size;
	}

	public function check() {
		$error = $this->getError();
		if(!($error == 0)) {
			switch ($error) {
				case UPLOAD_ERR_INI_SIZE:
					throw new UploadException('File was too big! Max size is ' . ini_get('upload_max_filesize'));
					break;
			}
			return FALSE;
		}
		return TRUE;
	}

}

