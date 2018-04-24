<?php
namespace Undkonsorten\Addressmgmt\Service;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
		/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 "Eike Starkmann <eike.starkmann@posteo.de>"
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
 * @package Addressmgmt
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
 class Address {

 	/**
 	 * 
 	 * @param \Undkonsorten\Addressmgmt\Domain\Model\Address $address
 	 * @param boolean $forceUpdate
 	 */
 	public function updateCoordinates(\Undkonsorten\Addressmgmt\Domain\Model\Address $address, $forceUpdate = false){
 		if($address->getLatitude() == "" || $address->getLongitude() == "" || $forceUpdate){
	 		$base = "https://nominatim.openstreetmap.org/search/";
	 		$format = "json";
	 		$query = rawurlencode($address->getStreet()." ".$address->getStreetNumber()." ".$address->getZip()." ".$address->getCity());
	 		$result = json_decode(GeneralUtility::getUrl($base.$query."?format=".$format,0,['User-Agent: TYPO3-Extension-Addressmgmt']));
	 		$address->setLatitude($result{0}->lat);
	 		$address->setLongitude($result{0}->lon);
 		}	
 		
 	}
 
 }
