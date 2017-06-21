<?php
namespace Undkonsorten\Addressmgmt\Domain\Model;

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
interface AddressInterface {
	
	/**
	 * Type field for person
	 * 
	 * @var \string
	 */
	const PERSON = 'Tx_Addressbook_Person';
	
	/**
	 * Type field for organisation
	 * 
	 * @var \string
	 */
	const ORGANISATION = 'Tx_Addressbook_Organisation';
	
	/**
	 * 
	 * @var string
	 */
	const LOCATION = 'Tx_Addressbook_Location';

    /**
     * Created
     * @var integer
     */
	const PUBLISH_CREATED = 0;

    /**
     * Waiting
     * @var integer
     */
    const PUBLISH_WAITING = 1;

    /**
     * Published
     * @var integer
     */
    const PUBLISH_PUBLISHED = 2;


	/**
	 * return full name
	 * 
	 * @return \string
	 */
	public function getFullName();
	
	/**
	 * return name
	 * 
	 * @return \string
	 */
	public function getName();
	
	/**
	 * sets name
	 * 
	 * @param \string
	 * @return void
	 */
	public function setName($name);
	
	static function getTypeConstants();

}
?>