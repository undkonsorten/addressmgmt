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
 * Test case for class \Undkonsorten\People\Domain\Model\SocialIdentifier.
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
class SocialIdentifierTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Undkonsorten\People\Domain\Model\SocialIdentifier
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Undkonsorten\People\Domain\Model\SocialIdentifier();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getIdentifierReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIdentifierForStringSetsIdentifier() { 
		$this->fixture->setIdentifier('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIdentifier()
		);
	}
	
	/**
	 * @test
	 */
	public function getUrlOverrideReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setUrlOverrideForStringSetsUrlOverride() { 
		$this->fixture->setUrlOverride('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getUrlOverride()
		);
	}
	
	/**
	 * @test
	 */
	public function getProviderReturnsInitialValueForSocialProvider() { }

	/**
	 * @test
	 */
	public function setProviderForSocialProviderSetsProvider() { }
	
}
?>