<?php
namespace Undkonsorten\Addressmgmt\Utility\Evaluation;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Felix Althaus <felix.althaus@undkonsorten.com>, undkonsorten
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
class Coordinate {

	/**
	 * returns function body for javascript validation
	 * @TODO Add when possible, now breaks because of http://forge.typo3.org/issues/52904
	 * 
	 * @return string
	 */
	/*public function returnFieldJS() {
		return '
		return value;
		';
	}*/
	
	/**
	 * evaluates the value in BE
	 * @TODO better normalization/distinguish longitude/latitude
	 * 
	 * @param string $value Value in the field when submitted
	 * @param string $is_in Value of the is_in key of TCA column configuration
	 * @param bool &$set Write to database?
	 * @return $value the evaluated value
	 */
	public function evaluateFieldValue($value, $is_in, &$set) {
		if(strpos($value, ',') > -1 && !(strpos($value, '.') > -1)) {
			$value = str_replace(',', '.', $value);
		}
		return sprintf('%01.6f', $value);
	}

}
?>
