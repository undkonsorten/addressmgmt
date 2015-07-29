<?php
namespace Undkonsorten\Addressmgmt\Controller;


use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Eike Starkmann <starkmann@undkonsorten.com>, undkonsorten
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
 * BaseController
 */
class BaseController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
	 */
	protected $typoScriptFrontendController;

	/**
	 * configuration manager
	 *
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;

	public function __construct(){
		$this->typoScriptFrontendController = $this->getTyposcriptFrontendController();
	}

	/**
	* @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
	*/
	protected function getTyposcriptFrontendController() {
		if (is_null($this->typoScriptFrontendController)) {
			$this->typoScriptFrontendController = $GLOBALS['TSFE'];
		}
		return $this->typoScriptFrontendController;
	}

	/**
	 * Requires CHash for the current action
	 * log to devLog if no CHash was given
	 *
	 * @return void
	 */
	protected function requireCacheHash() {
		$this->typoScriptFrontendController->reqCHash();

		//@TODO respect logging settings from extension here
		if(!$this->typoScriptFrontendController->cHash) {
			GeneralUtility::devLog(
			"There was no cHash given to this action, 1410970141",
			$this->extensionName,
			GeneralUtility::SYSLOG_SEVERITY_NOTICE,
			array(
			'referrer' => GeneralUtility::getIndpEnv('HTTP_REFERER'),
			'requestUri' => GeneralUtility::getIndpEnv('REQUEST_URI'),
			'controller' => $this->controllerContext->getRequest()->getControllerName(),
			'action' => $this->controllerContext->getRequest()->getControllerActionName(),
			)
			);
		}
	}

	/**
	 * overrides flexform settings with original typoscript values when
	 * flexform value is empty and settings key is defined in
	 * 'settings.overrideFlexformSettingsIfEmpty'
	 *
	 * @return void
	 */
	protected function overrideFlexformSettings() {

		$originalSettings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
		$typoScriptSettings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, $this->extensionName);
		if(isset($typoScriptSettings['settings']['overrideFlexformSettingsIfEmpty'])) {
			$overrideIfEmpty = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $typoScriptSettings['settings']['overrideFlexformSettingsIfEmpty'], TRUE);
			foreach ($overrideIfEmpty as $settingToOverride) {
				// if flexform setting is empty and value is available in TS
				if ((!isset($originalSettings[$settingToOverride]) || empty($originalSettings[$settingToOverride]))
						&& isset($typoScriptSettings['settings'][$settingToOverride])) {
							$originalSettings[$settingToOverride] = $typoScriptSettings['settings'][$settingToOverride];
						}
			}
			$this->settings = $originalSettings;
		}
	}

	/**
	 * Debugs a SQL query from a QueryResult
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult
	 * @param boolean $explainOutput
	 * @return void
	 */
	protected function debugQuery(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult, $explainOutput = FALSE){
		$GLOBALS['TYPO3_DB']->debugOuput = 2;
		if($explainOutput){
			$GLOBALS['TYPO3_DB']->explainOutput = true;
		}
		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
		$queryResult->toArray();
		//DebuggerUtility::var_dump($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = false;
		$GLOBALS['TYPO3_DB']->explainOutput = false;
		$GLOBALS['TYPO3_DB']->debugOuput = false;
	}

	/**
	 * Adds cache tag to page cache entry
	 * uses extension key if no tag is given
	 * used to clear cache with cache tags. Add this in TSConfig:
	 * TCEMAIN.clearCacheCmd = cacheTag:<extkey_without_tx>
	 *
	 * @param string $cacheTag the tag
	 * @return void
	 */
	protected function addCacheTag($cacheTag = NULL) {
		/* @var $tagAdded \boolean */
		static $tagAdded = FALSE;
		$cacheTag = $cacheTag ? : $this->request->getControllerExtensionKey();
		if (!$tagAdded) {
			$this->typoScriptFrontendController->addCacheTags(array($cacheTag));
			$tagAdded = TRUE;
		}
	}

	/**
	 * @return void
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->addCacheTag();
	}


	protected function getErrorFlashMessage() {
		//#DebuggerUtility::var_dump($this->controllerContext->getArguments()->getValidationResults()->getFlattenedErrors());
		return FALSE;
	}

}