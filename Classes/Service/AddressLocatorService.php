<?php

namespace Undkonsorten\Addressmgmt\Service;

use Undkonsorten\Addressmgmt\Domain\Model\Address;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 "Eike Starkmann <eike.starkmann@posteo.de>"
 *  (c) 2018 "Felix Althaus <felix.althaus@undkonsorten.com>"
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
class AddressLocatorService
{

    /**
     * @var GeoLocationServiceInterface
     */
    protected $geolocationService;

    /**
     * @param GeoLocationServiceInterface $geoLocationService
     */
    public function injectGeolocationService(GeoLocationServiceInterface $geoLocationService)
    {
        $this->geolocationService = $geoLocationService;
    }

    /**
     * @var array
     */
    protected $propertiesToConsider = ['street', 'streetNumber', 'zip', 'city'];

    /**
     * Updates coordinates of a given address if necessary / indicated
     *
     * @param Address $address
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception\TooDirtyException
     */
    public function updateCoordinates(Address $address)
    {
        $shouldUpdate = $this->shouldUpdateCoordinates($address, $this->propertiesToConsider);
        if ($shouldUpdate) {
            $results = $this->geolocationService->locate($this->generateQuery($address));
            $result = $results[0] ?: [];
            $this->updateAddressWithResult($address, $result['lat'], $result['lon']);
        }
    }

    /**
     * @param Address $address
     * @param array $propertiesToConsider
     * @return bool
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception\TooDirtyException
     */
    protected function shouldUpdateCoordinates(
        Address $address,
        $propertiesToConsider = []
    ) {
        $coordinatesDirty = $address->_isDirty('latitude') && $address->_isDirty('longitude');
        $isNew = $address->_isNew();
        $propertiesDirty = array_reduce($propertiesToConsider, function ($carry, $property) use ($address) {
            return $carry || $address->_isDirty($property);
        }, false);
        return !$coordinatesDirty && ($isNew || $propertiesDirty);
    }

    /**
     * @param Address $address
     * @return string
     */
    protected function generateQuery(Address $address)
    {
        return implode(' ', array_map(function ($property) use ($address) {
            return $address->_getProperty($property);
        }, $this->propertiesToConsider));
    }

    /**
     * @param Address $address
     * @param string $latitude
     * @param string $longitude
     */
    protected function updateAddressWithResult(Address $address, $latitude = null, $longitude = null)
    {
        $address->setLatitude($latitude);
        $address->setLongitude($longitude);
    }

}
