<?php

namespace Undkonsorten\People\Tests;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Felix Althaus <felix.althaus@undkonsorten.com>, undkonsorten
 *  			Eike Starkmann <eike.starkmann@undkonsorten.com>, undkonsorten
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Undkonsorten\People\Domain\Model\Person.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage People
 *
 * @author Felix Althaus <felix.althaus@undkonsorten.com>
 * @author Eike Starkmann <eike.starkmann@undkonsorten.com>
 */
class PersonTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Undkonsorten\People\Domain\Model\Person
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Undkonsorten\People\Domain\Model\Person();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName() { 
		$this->fixture->setFirstName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFirstName()
		);
	}
	
	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName() { 
		$this->fixture->setLastName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLastName()
		);
	}
	
	/**
	 * @test
	 */
	public function getGenderReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getGender()
		);
	}

	/**
	 * @test
	 */
	public function setGenderForIntegerSetsGender() { 
		$this->fixture->setGender(12);

		$this->assertSame(
			12,
			$this->fixture->getGender()
		);
	}
	
	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getOrganizationReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setOrganizationForStringSetsOrganization() { 
		$this->fixture->setOrganization('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getOrganization()
		);
	}
	
	/**
	 * @test
	 */
	public function getDepartmentReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDepartmentForStringSetsDepartment() { 
		$this->fixture->setDepartment('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDepartment()
		);
	}
	
	/**
	 * @test
	 */
	public function getStreetReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setStreetForStringSetsStreet() { 
		$this->fixture->setStreet('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getStreet()
		);
	}
	
	/**
	 * @test
	 */
	public function getStreetNumberReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setStreetNumberForStringSetsStreetNumber() { 
		$this->fixture->setStreetNumber('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getStreetNumber()
		);
	}
	
	/**
	 * @test
	 */
	public function getAddressSupplementReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAddressSupplementForStringSetsAddressSupplement() { 
		$this->fixture->setAddressSupplement('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAddressSupplement()
		);
	}
	
	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() { 
		$this->fixture->setCity('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCity()
		);
	}
	
	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setZipForStringSetsZip() { 
		$this->fixture->setZip('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getZip()
		);
	}
	
	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCountryForStringSetsCountry() { 
		$this->fixture->setCountry('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCountry()
		);
	}
	
	/**
	 * @test
	 */
	public function getStateReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setStateForStringSetsState() { 
		$this->fixture->setState('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getState()
		);
	}
	
	/**
	 * @test
	 */
	public function getClosestCityReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setClosestCityForStringSetsClosestCity() { 
		$this->fixture->setClosestCity('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getClosestCity()
		);
	}
	
	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() { 
		$this->fixture->setEmail('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getEmail()
		);
	}
	
	/**
	 * @test
	 */
	public function getPhoneReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPhoneForStringSetsPhone() { 
		$this->fixture->setPhone('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPhone()
		);
	}
	
	/**
	 * @test
	 */
	public function getMobileReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setMobileForStringSetsMobile() { 
		$this->fixture->setMobile('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getMobile()
		);
	}
	
	/**
	 * @test
	 */
	public function getFaxReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFaxForStringSetsFax() { 
		$this->fixture->setFax('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFax()
		);
	}
	
	/**
	 * @test
	 */
	public function getWwwReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setWwwForStringSetsWww() { 
		$this->fixture->setWww('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getWww()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setImageForStringSetsImage() { 
		$this->fixture->setImage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getImage()
		);
	}
	
	/**
	 * @test
	 */
	public function getLatitudeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLatitudeForStringSetsLatitude() { 
		$this->fixture->setLatitude('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLatitude()
		);
	}
	
	/**
	 * @test
	 */
	public function getLongitudeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLongitudeForStringSetsLongitude() { 
		$this->fixture->setLongitude('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLongitude()
		);
	}
	
	/**
	 * @test
	 */
	public function getFeUserReturnsInitialValueForFrontendUser() { }

	/**
	 * @test
	 */
	public function setFeUserForFrontendUserSetsFeUser() { }
	
	/**
	 * @test
	 */
	public function getSocialIdentifiersReturnsInitialValueForSocialIdentifier() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getSocialIdentifiers()
		);
	}

	/**
	 * @test
	 */
	public function setSocialIdentifiersForObjectStorageContainingSocialIdentifierSetsSocialIdentifiers() { 
		$socialIdentifier = new \Undkonsorten\People\Domain\Model\SocialIdentifier();
		$objectStorageHoldingExactlyOneSocialIdentifiers = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneSocialIdentifiers->attach($socialIdentifier);
		$this->fixture->setSocialIdentifiers($objectStorageHoldingExactlyOneSocialIdentifiers);

		$this->assertSame(
			$objectStorageHoldingExactlyOneSocialIdentifiers,
			$this->fixture->getSocialIdentifiers()
		);
	}
	
	/**
	 * @test
	 */
	public function addSocialIdentifierToObjectStorageHoldingSocialIdentifiers() {
		$socialIdentifier = new \Undkonsorten\People\Domain\Model\SocialIdentifier();
		$objectStorageHoldingExactlyOneSocialIdentifier = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneSocialIdentifier->attach($socialIdentifier);
		$this->fixture->addSocialIdentifier($socialIdentifier);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneSocialIdentifier,
			$this->fixture->getSocialIdentifiers()
		);
	}

	/**
	 * @test
	 */
	public function removeSocialIdentifierFromObjectStorageHoldingSocialIdentifiers() {
		$socialIdentifier = new \Undkonsorten\People\Domain\Model\SocialIdentifier();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($socialIdentifier);
		$localObjectStorage->detach($socialIdentifier);
		$this->fixture->addSocialIdentifier($socialIdentifier);
		$this->fixture->removeSocialIdentifier($socialIdentifier);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getSocialIdentifiers()
		);
	}
	
}
?>