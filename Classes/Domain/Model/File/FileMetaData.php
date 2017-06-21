<?php
namespace Undkonsorten\Addressmgmt\Domain\Model\File;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Eike Starkmann <starkmann@undkonsorten.com>, undkonsorten
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
 * @package speaker
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FileMetaData extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * @var \string
	 */
	protected $title;
	
	/**
	 * @var \string
	 */
	protected $alternative;
	
	/**
	 * @var \string
	 */
	protected $link;
	
	/**
	 * @var \string
	 */
	protected $description;
	
	/**
	 * gets the title
	 * 
	 * @return \string
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * set the title
	 * 
	 * @param \string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * gets the alternative
	 * 
	 * @return \string
	 */
	public function getAlternative() {
		return $this->alternative;
	}
	
	/**
	 * set the alternative
	 * 
	 * @param \string $alternative
	 */
	public function setAlternative($alternative) {
		$this->alternative = $alternative;
	}

	/**
	 * gets the description
	 * 
	 * @return \string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * set the description
	 * 
	 * @param \string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * gets the link
	 * 
	 * @return \string
	 */
	public function getLink() {
		return $this->link;
	}
	
	/**
	 * set the link
	 * 
	 * @param \string $link
	 */
	public function setLink($link) {
		$this->link = $link;
	}

}
?>