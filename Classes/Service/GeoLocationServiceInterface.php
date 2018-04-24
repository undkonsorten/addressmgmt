<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Undkonsorten\Addressmgmt\Service;

/**
 * Interface GeoLocationServiceInterface
 * @package Undkonsorten\Addressmgmt\Service
 * @author Felix Althaus <felix.althaus@undkonsorten.com>
 */
interface GeoLocationServiceInterface
{

    /**
     * Queries geolocation service for a given address
     *
     * @param string $address String defining the address to be looked up
     * @return array List of possible matches
     */
    public function locate($address);

}