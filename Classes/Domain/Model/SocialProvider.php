<?php
namespace Undkonsorten\Addressmgmt\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
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
class SocialProvider extends AbstractEntity {

	/**
  * name
  *
  * @var \string
  * @Validate("NotEmpty")
  */
 protected $name;

	/**
	 * identifier label
	 *
	 * @var \string
	 */
	protected $identifierLabel;

	/**
	 * identifier description
	 *
	 * @var \string
	 */
	protected $identifierDescription;

	/**
	 * urlScheme
	 *
	 * @var \string
	 */
	protected $urlScheme;

	/**
	 * url override label
	 *
	 * @var \string
	 */
	protected $urlOverrideLabel;

	/**
	 * url override description
	 *
	 * @var \string
	 */
	protected $urlOverrideDescription;

	/**
	 * show url override 
	 *
	 * @var \boolean
	 */
	protected $showUrlOverride;

	/**
	 * www
	 *
	 * @var \string
	 */
	protected $www;

	/**
  * image
  *
  * @var FileReference
  */
 protected $image;
	
	/**
	 * String representation of social provider
	 * 
	 * @return \string
	 */
	public function __toString() {
		return $this->getName();
	}

	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Gets the identifier label
	 * 
	 * @return \string
	 */
	public function getIdentifierLabel() {
		return $this->identifierLabel;
	}

	/**
	 * Sets the identifier label
	 * 
	 * @param \string $identifierLabel
	 * @return void
	 */
	public function setIdentifierLabel($identifierLabel) {
		$this->identifierLabel = $identifierLabel;
	}

	/**
	 * Gets the identifier description
	 * 
	 * @return \string
	 */
	public function getIdentifierDescription() {
		return $this->identifierDescription;
	}

	/**
	 * Sets the identifier description
	 * 
	 * @param \string $identifierDescription
	 * @return void
	 */
	public function setIdentifierDescription($identifierDescription) {
		$this->identifierDescription = $identifierDescription;
	}

	/**
	 * Returns the urlScheme
	 *
	 * @return \string $urlScheme
	 */
	public function getUrlScheme() {
		return $this->urlScheme;
	}

	/**
	 * Sets the urlScheme
	 *
	 * @param \string $urlScheme
	 * @return void
	 */
	public function setUrlScheme($urlScheme) {
		$this->urlScheme = $urlScheme;
	}

	/**
	 * Gets the url override label
	 * 
	 * @return \string
	 */
	public function getUrlOverrideLabel() {
		return $this->urlOverrideLabel;
	}

	/**
	 * Sets the url override label
	 * 
	 * @param \string $urlOverrideLabel
	 * @return void
	 */
	public function setUrlOverrideLabel($urlOverrideLabel) {
		$this->urlOverrideLabel = $urlOverrideLabel;
	}

	/**
	 * Gets the url override description
	 * 
	 * @return \string
	 */
	public function getUrlOverrideDescription() {
		return $this->urlOverrideDescription;
	}

	/**
	 * Sets the url override description
	 * 
	 * @param \string $urlOverrideDescription
	 * @return void
	 */
	public function setUrlOverrideDescription($urlOverrideDescription) {
		$this->urlOverrideDescription = $urlOverrideDescription;
	}

	/**
	 * Gets the status of show url override
	 * 
	 * @return \string
	 */
	public function getShowUrlOverride() {
		return $this->showUrlOverride;
	}

	/**
	 * Sets the status of show url override
	 * 
	 * @param \string $showUrlOverride
	 * @return void
	 */
	public function setShowUrlOverride($showUrlOverride) {
		$this->showUrlOverride = $showUrlOverride;
	}

	/**
	 * Returns the www
	 *
	 * @return \string $www
	 */
	public function getWww() {
		return $this->www;
	}

	/**
	 * Sets the www
	 *
	 * @param \string $www
	 * @return void
	 */
	public function setWww($www) {
		$this->www = $www;
	}

	/**
  * Returns the image
  *
  * @return FileReference $image
  */
 public function getImage() {
		return $this->image;
	}

	/**
  * Sets the image
  *
  * @param FileReference $image
  * @return void
  */
 public function setImage($image) {
		$this->image = $image;
	}

}
?>
