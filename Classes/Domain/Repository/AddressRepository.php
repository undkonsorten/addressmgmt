<?php
namespace Undkonsorten\Addressmgmt\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
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
class AddressRepository extends Repository
{

    protected $defaultOrderings = array(
        'name' => QueryInterface::ORDER_DESCENDING,
    );


    /**
     * Find addresses by categories
     * @param array $categories
     * @param array $orderings
     * @throws InvalidQueryException
     */
	public function findDemanded($addresses = null,$categories= null, $publishState = null, $orderings=null){
		$query = $this->createQuery();
		$constraints = array();
		if($orderings){
			 $query->setOrderings($orderings);
        }
        /** @noinspection NotOptimalIfConditionsInspection */
        /** @noinspection TypeUnsafeComparisonInspection */
        if(!is_null($addresses) && $addresses != ''){
            $querySettings = $query->getQuerySettings();
            $querySettings->setRespectStoragePage(false);
            $query->setQuerySettings($querySettings);
		    $query->matching(
                $query->in('uid', $addresses)
			);
		    return $query->execute();
        }

        /** @noinspection NotOptimalIfConditionsInspection */
        /** @noinspection TypeUnsafeComparisonInspection */
        if(!is_null($publishState) && $publishState != '') {
            $constraints[] =$query->equals('publishState', $publishState);
		}

        if(is_array($categories) && count($categories) > 0) {
            $constraints[] =$query->in('category.uid', $categories);
        }
		if(count($constraints)>0){
            $query->matching(
                $query->logicalAnd(...$constraints)
            );
        }

		return $query->execute();
	}
}

