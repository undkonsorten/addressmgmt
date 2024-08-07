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
use GeorgRinger\News\Utility\TemplateLayout;
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
		/** @var TemplateLayout $templateLayoutsUtility */
  $templateLayoutsUtility = GeneralUtility::makeInstance(\Undkonsorten\Addressmgmt\Utility\TemplateLayout::class);
		$templateLayouts = $templateLayoutsUtility->getAvailableTemplateLayouts($config['row']['pid'] ?? 0);
		foreach ($templateLayouts as $layout) {
			$additionalLayout = array(
				htmlspecialchars($GLOBALS['LANG']->sL($layout[0])),
				$layout[1]
			);
			array_push($config['items'], $additionalLayout);
		}
	}

}
