<?php
namespace Undkonsorten\Addressmgmt\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
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
 * Relation
 */
class Relation extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * room
	 *
	 * @var \Undkonsorten\Addressmgmt\Domain\Model\Room
	 */
	protected $room = NULL;

	/**
	 * location
	 *
	 * @var \Undkonsorten\Addressmgmt\Domain\Model\Address\Location
	 */
	protected $location = NULL;

	/**
	 * Returns the room
	 *
	 * @return \Undkonsorten\Addressmgmt\Domain\Model\Room $room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * Sets the room
	 *
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\Room $room
	 * @return void
	 */
	public function setRoom(\Undkonsorten\Addressmgmt\Domain\Model\Room $room) {
		$this->room = $room;
	}

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		
	}

	/**
	 * Returns the location
	 *
	 * @return \Undkonsorten\Addressmgmt\Domain\Model\Address\Location $location
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the location
	 *
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\Address\Location $location
	 * @return void
	 */
	public function setLocation(\Undkonsorten\Addressmgmt\Domain\Model\Address\Location $location) {
		$this->location = $location;
	}

}
