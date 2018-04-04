<?php

namespace Undkonsorten\Addressmgmt\Service;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class NominatimGeolocationService
 * @package Undkonsorten\Addressmgmt\Service
 * @author Eike Starkmann <eike.starkmann@posteo.de>
 * @author Felix Althaus <felix.althaus@undkonsorten.com>
 */
class NominatimGeolocationService implements GeoLocationServiceInterface
{

    /**
     * Scheme for querying the webservice
     *
     * @var string
     */
    protected $uriScheme = 'https://nominatim.openstreetmap.org/search.php?q=%s&format=%s';

    /**
     * Format for result
     *
     * @var string
     */
    protected $format = 'json';

    /**
     * Headers to send along with the request
     *
     * @var array
     */
    protected $headers = ['User-Agent: TYPO3-Extension-Addressmgmt'];

    /**
     * Queries nominatim geolocation service for a given address
     *
     * @param string $address String defining the address to be looked up
     * @return array List of possible matches
     */
    public function locate($address)
    {
        $query = rawurlencode($address);
        $url = sprintf($this->uriScheme, $query, $this->format);
        // @Todo replace with guzzle when dropping support for TYPO3 7.6 (classic install)
        $response = GeneralUtility::getUrl($url, 0, $this->headers);
        return json_decode($response);
    }
}