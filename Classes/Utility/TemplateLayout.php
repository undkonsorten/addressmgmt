<?php

namespace Undkonsorten\Addressmgmt\Utility;

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
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * TemplateLayout utility class
 */
class TemplateLayout implements SingletonInterface {

	/**
	 * Get available template layouts for a certain page
	 *
	 * @param int $pageUid
	 * @return array
	 */
	public function getAvailableTemplateLayouts($pageUid) {
		$templateLayouts = array();

		// Check if the layouts are extended by ext_tables
		if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['addressmgmt']['templateLayouts'])
			&& is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['addressmgmt']['templateLayouts'])
		) {
			$templateLayouts = $GLOBALS['TYPO3_CONF_VARS']['EXT']['addressmgmt']['templateLayouts'];
		}

		// Add TsConfig values
		foreach ($this->getTemplateLayoutsFromTsConfig($pageUid) as $templateKey => $title) {
			if (\str_starts_with($title, '--div--')) {
				$optGroupParts = GeneralUtility::trimExplode(',', $title, TRUE, 2);
				$title = $optGroupParts[1];
				$templateKey = $optGroupParts[0];
			}
			$templateLayouts[] = array($title, $templateKey);
		}

		return $templateLayouts;
	}

	/**
	 * Get template layouts defined in TsConfig
	 *
	 * @param $pageUid
	 * @return array
	 */
	protected function getTemplateLayoutsFromTsConfig($pageUid) {
		$templateLayouts = array();
		$pagesTsConfig = BackendUtility::getPagesTSconfig($pageUid);
		if (isset($pagesTsConfig['tx_addressmgmt.']['templateLayouts.']) && is_array($pagesTsConfig['tx_addressmgmt.']['templateLayouts.'])) {
			$templateLayouts = $pagesTsConfig['tx_addressmgmt.']['templateLayouts.'];
		}
		return $templateLayouts;
	}
}