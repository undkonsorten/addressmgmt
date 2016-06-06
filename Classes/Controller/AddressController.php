<?php
namespace Undkonsorten\Addressmgmt\Controller;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
class AddressController extends BaseController{

	/**
	 * addressRepository
	 *
	 * @var \Undkonsorten\Addressmgmt\Domain\Repository\AddressRepository
	 * @inject
	 */
	protected $addressRepository;

	/**
	 * personRepository
	 *
	 * @var \Undkonsorten\Addressmgmt\Domain\Repository\Address\PersonRepository
	 * @inject
	 */
	protected $personRepository;

	/**
	 * organisationRepository
	 *
	 * @var \Undkonsorten\Addressmgmt\Domain\Repository\Address\OrganisationRepository
	 * @inject
	 */
	protected $organisationRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		if($this->settings['orderBy'] && $this->settings['orderDirection']){
			$orderings = array($this->settings['orderBy'] => $this->settings['orderDirection']);
		}
		if($this->settings['listType']=='all' && $this->settings['category']){
			$addresses = $this->addressRepository->findByCategories(GeneralUtility::intExplode(',', $this->settings['category']),$orderings);
		}
		
		if($this->settings['listType']=='manual' && $this->settings['addresses']){
			$addresses = array();
			foreach(GeneralUtility::intExplode(',', $this->settings['addresses']) as $uid){
				$addresses[] = $this->addressRepository->findByUid($uid);
			}
		}
		
		if(!$addresses){
			$addresses = $this->addressRepository->findAll();
			$this->debugQuery($this->addressRepository->findAll());
		}
		
		$this->view->assign('addresss', $addresses);
		$this->view->assign('contendUid', $this->configurationManager->getContentObject()->data['uid']);
	}

	/**
	 * action show
	 *
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\Address $address
	 * @return void
	 */
	public function showAction(\Undkonsorten\Addressmgmt\Domain\Model\Address $address) {
		$this->view->assign('address', $address);
	}

}
?>