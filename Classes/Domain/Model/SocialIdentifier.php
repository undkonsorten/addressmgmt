<?php
namespace Undkonsorten\Addressmgmt\Domain\Model;

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
class SocialIdentifier extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * identifier
	 *
	 * @var \string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $identifier;

	/**
	 * urlOverride
	 *
	 * @var \string
	 */
	protected $urlOverride;

	/**
	 * provider
	 *
	 * @var \Undkonsorten\Addressmgmt\Domain\Model\SocialProvider
	 */
	protected $provider;
	
	/**
	 * Returns string representation of identifier
	 * 
	 * @return \string
	 */
	public function __toString() {
		return $this->getIdentifier();
	}

	/**
	 * Returns the identifier
	 *
	 * @return \string $identifier
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * Sets the identifier
	 *
	 * @param \string $identifier
	 * @return void
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
	}
	
	/**
	 * Returns url as from provider template if not locally overridden
	 * 
	 * @return \string
	 */
	public function getUrl() {
		if (is_string($this->getUrlOverride()) && strlen($this->getUrlOverride())) {
			return $this->getUrlOverride();
		} elseif ($this->getProvider()->getUrlScheme()) {
			return sprintf($this->getProvider()->getUrlScheme(), $this->getIdentifier());
		}
		return null;
	}

	/**
	 * Returns the urlOverride
	 *
	 * @return \string $urlOverride
	 */
	public function getUrlOverride() {
		return $this->urlOverride;
	}

	/**
	 * Sets the urlOverride
	 *
	 * @param \string $urlOverride
	 * @return void
	 */
	public function setUrlOverride($urlOverride) {
		$this->urlOverride = $urlOverride;
	}

	/**
	 * Returns the provider
	 *
	 * @return \Undkonsorten\Addressmgmt\Domain\Model\SocialProvider $provider
	 */
	public function getProvider() {
		return $this->provider;
	}

	/**
	 * Sets the provider
	 *
	 * @param \Undkonsorten\Addressmgmt\Domain\Model\SocialProvider $provider
	 * @return void
	 */
	public function setProvider(\Undkonsorten\Addressmgmt\Domain\Model\SocialProvider $provider) {
		$this->provider = $provider;
	}

}
?>
