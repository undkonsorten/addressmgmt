<?php namespace Undkonsorten\Addressmgmt\Service;

use TYPO3\CMS\Extbase\Reflection\ObjectAccess;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Felix Althaus <felix.althaus@undkonsorten.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the text file GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
class ExtensionConfigurationService {
	
	/**
	 * @var \array
	 */
	protected $configuration;
	
	/**
	 * @param \string $extensionKey
	 * @return \Undkonsorten\Publications\Service\ExtensionConfigurationService
	 */
	static public function getInstance($extensionKey) {
		return GeneralUtility::makeInstance(self::class, $extensionKey);
	}
	
	/**
	 * @param \string $extensionKey
	 */
	public function __construct($extensionKey = NULL) {
		if (!is_string($extensionKey)) {
			$extensionKey = $this->getExtensionKeyFromNamespace();
		} 
		$this->load($extensionKey);
	}
	
	/**
	 * @param \string $extensionKey
	 */
	public function load($extensionKey) {
		$this->configuration = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS'][$extensionKey] ?? [];
	}
	
	/**
	 * @param \string $propertyPath
	 * @return \mixed
	 */
	public function getProperty($propertyPath) {
		return ObjectAccess::getPropertyPath($this->configuration, $propertyPath);
	}
	
	protected function getExtensionKeyFromNamespace() {
		$namespace = __NAMESPACE__;
		$extensionName = explode('\\', $namespace)[1];
		return GeneralUtility::camelCaseToLowerCaseUnderscored($extensionName);
	}
}
