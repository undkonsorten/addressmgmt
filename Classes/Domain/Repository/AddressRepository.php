<?php
namespace Undkonsorten\Addressmgmt\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
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
 * @package addressbook
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AddressRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	
	protected $defaultOrderings = array(
			'name' => QueryInterface::ORDER_DESCENDING,
	);
	
	/**
	 * Sets repository-wide query settings
	 *
	 * @return void
	 */
	public function initializeObject() {
		/* @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}

	/**
	 * Find addresses by categories
	 * @param array $categories
	 * @param array $orderings
	 */
	public function findByCategories($categories, $orderings=NULL){
		$query = $this->createQuery();
		$constraints = array();
		if(count($categories)>1){
			foreach ($categories as $category){
				$constraints[] = $query->contains('category', $category);
			}
			$query->matching(
					$query->logicalAnd($constraints)
			);
		}else{
			$query->matching(
					$query->contains('category', $categories)
			);
		}
		if($orderings){
			$query->setOrderings($orderings);
		}
		return $query->execute();
	}
}
?>