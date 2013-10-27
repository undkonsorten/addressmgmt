<?php
namespace Undkonsorten\Addressbook\Domain\Model;

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
 * @package addressbook
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
abstract class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity implements AddressInterface {

	/**
	 * type
	 *
	 * @var \string
	 */
	protected $type;

	/**
	 * name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * organization
	 *
	 * @var \string
	 */
	protected $organization;

	/**
	 * department
	 *
	 * @var \string
	 */
	protected $department;

	/**
	 * street
	 *
	 * @var \string
	 */
	protected $street;

	/**
	 * streetNumber
	 *
	 * @var \string
	 */
	protected $streetNumber;

	/**
	 * addressSupplement
	 *
	 * @var \string
	 */
	protected $addressSupplement;

	/**
	 * city
	 *
	 * @var \string
	 */
	protected $city;

	/**
	 * zip
	 *
	 * @var \string
	 */
	protected $zip;

	/**
	 * country
	 *
	 * @var \string
	 */
	protected $country;

	/**
	 * state
	 *
	 * @var \string
	 */
	protected $state;

	/**
	 * closestCity
	 *
	 * @var \string
	 */
	protected $closestCity;

	/**
	 * email
	 *
	 * @var \string
	 */
	protected $email;

	/**
	 * phone
	 *
	 * @var \string
	 */
	protected $phone;

	/**
	 * mobile
	 *
	 * @var \string
	 */
	protected $mobile;

	/**
	 * fax
	 *
	 * @var \string
	 */
	protected $fax;

	/**
	 * www
	 *
	 * @var \string
	 */
	protected $www;

	/**
	 * description
	 *
	 * @var \string
	 */
	protected $description;

	/**
	 * image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image;

	/**
	 * latitude
	 *
	 * @var \string
	 */
	protected $latitude;

	/**
	 * longitude
	 *
	 * @var \string
	 */
	protected $longitude;

	/**
	 * feUser
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 */
	protected $feUser;

	/**
	 * socialIdentifiers
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Undkonsorten\Addressbook\Domain\Model\SocialIdentifier>
	 * @lazy
	 */
	protected $socialIdentifiers;

	/**
	 * __construct
	 *
	 * @return Address
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->socialIdentifiers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}
	
	/**
	 * String representation of address
	 * 
	 * @return \string
	 */
	public function __toString() {
		return $this->getFullName();
	}
	
	/**
	 * Returns the type
	 * 
	 * @return \string
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * Sets the type
	 * 
	 * @param \string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}
	
	/**
	 * Returns the Name
	 *
	 * @return \string $Name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the Name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * return full name
	 * 
	 * @return \string
	 */
	public function getFullName() {
		return $this->getName();
	}

	/**
	 * Returns the organization
	 *
	 * @return \string $organization
	 */
	public function getOrganization() {
		return $this->organization;
	}

	/**
	 * Sets the organization
	 *
	 * @param \string $organization
	 * @return void
	 */
	public function setOrganization($organization) {
		$this->organization = $organization;
	}

	/**
	 * Returns the department
	 *
	 * @return \string $department
	 */
	public function getDepartment() {
		return $this->department;
	}

	/**
	 * Sets the department
	 *
	 * @param \string $department
	 * @return void
	 */
	public function setDepartment($department) {
		$this->department = $department;
	}

	/**
	 * Returns the street
	 *
	 * @return \string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Sets the street
	 *
	 * @param \string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Returns the streetNumber
	 *
	 * @return \string $streetNumber
	 */
	public function getStreetNumber() {
		return $this->streetNumber;
	}

	/**
	 * Sets the streetNumber
	 *
	 * @param \string $streetNumber
	 * @return void
	 */
	public function setStreetNumber($streetNumber) {
		$this->streetNumber = $streetNumber;
	}

	/**
	 * Returns the addressSupplement
	 *
	 * @return \string $addressSupplement
	 */
	public function getAddressSupplement() {
		return $this->addressSupplement;
	}

	/**
	 * Sets the addressSupplement
	 *
	 * @param \string $addressSupplement
	 * @return void
	 */
	public function setAddressSupplement($addressSupplement) {
		$this->addressSupplement = $addressSupplement;
	}

	/**
	 * Returns the city
	 *
	 * @return \string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param \string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the zip
	 *
	 * @return \string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param \string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the country
	 *
	 * @return \string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the state
	 *
	 * @return \string $state
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Sets the state
	 *
	 * @param \string $state
	 * @return void
	 */
	public function setState($state) {
		$this->state = $state;
	}

	/**
	 * Returns the closestCity
	 *
	 * @return \string $closestCity
	 */
	public function getClosestCity() {
		return $this->closestCity;
	}

	/**
	 * Sets the closestCity
	 *
	 * @param \string $closestCity
	 * @return void
	 */
	public function setClosestCity($closestCity) {
		$this->closestCity = $closestCity;
	}

	/**
	 * Returns the email
	 *
	 * @return \string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param \string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the phone
	 *
	 * @return \string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param \string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Returns the mobile
	 *
	 * @return \string $mobile
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * Sets the mobile
	 *
	 * @param \string $mobile
	 * @return void
	 */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}

	/**
	 * Returns the fax
	 *
	 * @return \string $fax
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the fax
	 *
	 * @param \string $fax
	 * @return void
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}

	/**
	 * Returns the www
	 *
	 * @return \string $www
	 */
	public function getWww() {
		return $this->www;
	}

	/**
	 * Sets the www
	 *
	 * @param \string $www
	 * @return void
	 */
	public function setWww($www) {
		$this->www = $www;
	}

	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}
	
	/**
	 * Coordinates as array of floats
	 * 
	 * @return array<float>
	 */
	public function getCoordinates() {
		return array(
			'longitude' => $this->getLongitude(),
			'latitude' => $this->getLatitude(),
		);
	}

	/**
	 * Returns the latitude
	 *
	 * @return \float $latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Sets the latitude
	 *
	 * @param \float $latitude
	 * @return void
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * Returns the longitude
	 *
	 * @return \float $longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Sets the longitude
	 *
	 * @param \float $longitude
	 * @return void
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	/**
	 * Returns the feUser
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
	 */
	public function getFeUser() {
		return $this->feUser;
	}

	/**
	 * Sets the feUser
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
	 * @return void
	 */
	public function setFeUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser) {
		$this->feUser = $feUser;
	}

	/**
	 * Adds a SocialIdentifier
	 *
	 * @param \Undkonsorten\Addressbook\Domain\Model\SocialIdentifier $socialIdentifier
	 * @return void
	 */
	public function addSocialIdentifier(\Undkonsorten\Addressbook\Domain\Model\SocialIdentifier $socialIdentifier) {
		$this->socialIdentifiers->attach($socialIdentifier);
	}

	/**
	 * Removes a SocialIdentifier
	 *
	 * @param \Undkonsorten\Addressbook\Domain\Model\SocialIdentifier $socialIdentifierToRemove The SocialIdentifier to be removed
	 * @return void
	 */
	public function removeSocialIdentifier(\Undkonsorten\Addressbook\Domain\Model\SocialIdentifier $socialIdentifierToRemove) {
		$this->socialIdentifiers->detach($socialIdentifierToRemove);
	}

	/**
	 * Returns the socialIdentifiers
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Undkonsorten\Addressbook\Domain\Model\SocialIdentifier> $socialIdentifiers
	 */
	public function getSocialIdentifiers() {
		return $this->socialIdentifiers;
	}

	/**
	 * Sets the socialIdentifiers
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Undkonsorten\Addressbook\Domain\Model\SocialIdentifier> $socialIdentifiers
	 * @return void
	 */
	public function setSocialIdentifiers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $socialIdentifiers) {
		$this->socialIdentifiers = $socialIdentifiers;
	}

}
?>
