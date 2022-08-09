<?php
namespace Undkonsorten\Addressmgmt\Domain\Repository;

use TYPO3\CMS\Core\Resource\File;
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
class FileRepository {
	
	/**
  * add method isn't implemented, use resourceFactory instead
  *
  * @param File $file
  * @throws \BadMethodCallException
  */
 public function add(File $file) {
		throw new \BadMethodCallException('Use resourceFactory to add uploaded file', 1383232691);
	}
	
	/**
  * updates a file
  *
  * @param File $file
  * @return void
  */
 public function update(File $file) {
		//@TODO implement, use FileRepository
	}
	
	/**
  * Deletes a file from persistence
  *
  * @param File $file
  */
 public function delete(File $file) {
		//@TODO implement, check for existing references pointing to file first
	}
	
	/**
  * finds a file by uid 
  *
  * @param \integer $uid
  * @return File
  */
 public function findByUid($uid) {
		// @TODO implement
	}
	
}
?>