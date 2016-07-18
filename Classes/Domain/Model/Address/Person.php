<?php
namespace Undkonsorten\Addressmgmt\Domain\Model\Address;

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
class Person extends \Undkonsorten\Addressmgmt\Domain\Model\Address {

	/**
	 * firstName
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $firstName;

	/**
	 * gender
	 *
	 * @var \integer
	 */
	protected $gender;

	/**
	 * title
	 *
	 * @var \string
	 */
	protected $title;
	
	/**
	 * String representation of address
	 * 
	 * @return \string
	 */
	public function __toString() {
		return $this->getFullName();
	}
	
	/**
	 * return full name as first name last name
	 * 
	 * @return \string
	 */
	public function getFullName() {
		return $this->getFirstName() . ' ' . $this->getLastName();
	}

	/**
	 * Returns the firstName
	 *
	 * @return \string $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param \string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the lastName
	 *
	 * @return \string $lastName
	 */
	public function getLastName() {
		return $this->getName();
	}

	/**
	 * Sets the lastName
	 *
	 * @param \string $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		$this->setName($lastName);
	}

	/**
	 * Returns the gender
	 *
	 * @return \integer $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Sets the gender
	 *
	 * @param \integer $gender
	 * @return void
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

}
?>