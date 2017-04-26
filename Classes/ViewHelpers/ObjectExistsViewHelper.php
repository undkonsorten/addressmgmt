<?php
namespace Undkonsorten\Addressmgmt\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Karsten Nowak nowak@undkonsorten.com
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
 * ---------------------------------------------------------------
 * find an object from object storage by defined property.
 * use it in conditions for example
 *
 * don't forget namespace declaration in template file !
 *
 * <f:if condition="{u:objectExists(haystack:newsItem.categories,property:'uid',value:'2')}">
 *   <f:then>vorhanden</f:then>
 *   <f:else>nicht vorhanden</f:else>
 * </f:if>
 *
 * {f:if(condition:'{u:objectExists(haystack:newsItem.categories,property:\'uid\',value:\'2\')}',then:'vorhanden', else:'nicht vorhanden')}
 *
 ***************************************************************/
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;


class ObjectExistsViewHelper extends AbstractViewHelper {

    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('haystack', 'mixed', 'Viewhelpers haystack', true);
        $this->registerArgument('property', 'string', 'Property to check', true);
        $this->registerArgument('value', 'string', 'Value to compare', true);
    }

    /**
     * Check if there is an object with property = value
     *
     * @param string  $property
     * @param array	  $haystack
     * @param string  $value
     *
     * @return boolean
     * @api
     */
    public function render() {

        $propertyMethod = 'get'.ucfirst($this->arguments['property']);
        $haystack = $this->arguments['haystack'];
        $value = $this->arguments['value'];

        if(!is_object($haystack))
        {
            throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('Argument haystack has to be an object storage.', 1487763199);
        }

        foreach ($haystack as $keyValue => $singleElement)
        {
            if(!method_exists($singleElement, $propertyMethod))
            {
                throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('Property does not exists', 1487762501);
            }
            $data = $singleElement->$propertyMethod();
            if ($value == $data)
            {
                return true;
            }
        }
        return false;
    }

}

