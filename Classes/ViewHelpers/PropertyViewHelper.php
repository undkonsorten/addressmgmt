<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/***************************************************************
*  Copyright notice
*
*  (c) 2013 Felix Althaus <felix.althaus@undkonsorten.com>
*  (c) 2017 Eike Starkmann <eike.starkmann@undkonsorten.com>
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

class PropertyViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Arguments initialization
     *
     */
    public function initializeArguments()
    {
        $this->registerArgument('object', 'object|array', 'Object data');
        $this->registerArgument('property', 'string', 'Used property');
    }

	/**
	 * render
     *
	 * @return mixed
	 */
	public function render() {
        [
            'object' => $object,
            'property' => $property,
        ] = $this->arguments;
	    if(is_object($object)) {
	        return $object->$property;
	    } elseif(is_array($object)) {
	        if(array_key_exists($property, $object)) {
	            return $object[$property];
	        }
	    }
	    return NULL;
	}
}

?>
