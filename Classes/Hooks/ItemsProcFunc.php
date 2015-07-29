<?php

namespace Undkonsorten\Addressmgmt\Hooks;

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
 * Userfunc to render alternative label for media elements
 *
 * @package TYPO3
 * @subpackage tx_news
 */
class ItemsProcFunc {

	/**
	 * Itemsproc function to extend the selection of templateLayouts in the plugin
	 *
	 * @param array &$config configuration array
	 * @return void
	 */
	public function user_templateLayout(array &$config) {
		/** @var \GeorgRinger\News\Utility\TemplateLayout $templateLayoutsUtility */
		$templateLayoutsUtility = GeneralUtility::makeInstance('Undkonsorten\Addressmgmt\Utility\TemplateLayout');
		$templateLayouts = $templateLayoutsUtility->getAvailableTemplateLayouts($config['row']['pid']);
		foreach ($templateLayouts as $layout) {
			$additionalLayout = array(
				$GLOBALS['LANG']->sL($layout[0], TRUE),
				$layout[1]
			);
			array_push($config['items'], $additionalLayout);
		}
	}

}