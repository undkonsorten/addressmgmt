<?php
namespace Undkonsorten\Addressmgmt\Controller;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

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
class BaseController extends ActionController {

	/**
	 * @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
	 */
	protected $typoScriptFrontendController;

    /**
     * @var FrontendUserRepository
     */
    protected $frontendUserRepository;

    public function injectFrontendUserRepository(FrontendUserRepository $frontendUserRepository): void
    {
        $this->frontendUserRepository = $frontendUserRepository;
    }

    /**
     * @var ConfigurationManagerInterface
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
        //@TODO refactor to new logging API
//		if(!$this->typoScriptFrontendController->cHash) {
//			GeneralUtility::devLog(
//			"There was no cHash given to this action, 1410970141",
//			$this->extensionName,
//			GeneralUtility::SYSLOG_SEVERITY_NOTICE,
//			array(
//			'referrer' => GeneralUtility::getIndpEnv('HTTP_REFERER'),
//			'requestUri' => GeneralUtility::getIndpEnv('REQUEST_URI'),
//			'controller' => $this->controllerContext->getRequest()->getControllerName(),
//			'action' => $this->controllerContext->getRequest()->getControllerActionName(),
//			)
//			);
//		}
	}

	/**
	 * overrides flexform settings with original typoscript values when
	 * flexform value is empty and settings key is defined in
	 * 'settings.overrideFlexformSettingsIfEmpty'
	 *
	 * @return void
	 */
	public function injectConfigurationManager(ConfigurationManagerInterface $configurationManager) {
        $this->configurationManager = $configurationManager;
		$originalSettings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
		$typoScriptSettings = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
            'addressmgmt',
            'addressmgmt_list'
		    );
		if(isset($typoScriptSettings['settings']['overrideFlexformSettingsIfEmpty'])) {
			$overrideIfEmpty = GeneralUtility::trimExplode(',', $typoScriptSettings['settings']['overrideFlexformSettingsIfEmpty'], TRUE);
			foreach ($overrideIfEmpty as $settingToOverride) {
				// if flexform setting is empty and value is available in TS
                if (
                    ArrayUtility::isValidPath($typoScriptSettings['settings'], $settingToOverride, '.')
                    && (
                        !ArrayUtility::isValidPath($originalSettings, $settingToOverride,'.')
                        || (empty(ArrayUtility::getValueByPath($originalSettings,$settingToOverride,'.')) && ArrayUtility::getValueByPath($originalSettings,$settingToOverride,'.') !== '0')
                    )
                ) {
                    $originalSettings = ArrayUtility::setValueByPath(
                        $originalSettings,
                        $settingToOverride,
                        ArrayUtility::getValueByPath(
                            $typoScriptSettings['settings'],
                            $settingToOverride,
                            '.'
                        ),
                        '.'
                    );
                }
			}
			$this->settings = $originalSettings;
		}
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
		//#DebuggerUtility::var_dump($this->controllerContext->getArguments()->validate()->getFlattenedErrors());
		return FALSE;
	}

	/**
	 * overrides flexform settings with original typoscript values when
	 * flexform value is empty and settings key is defined in
	 * 'settings.overrideFlexformSettingsIfEmpty'
	 *
	 * @return void
	 */
	public function overrideFlexformSettings() {

	    $originalSettings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
	    $typoScriptSettings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, 'addressmgmt', 'address_list');
	    if(isset($typoScriptSettings['settings']['overrideFlexformSettingsIfEmpty'])) {
	        $overrideIfEmpty = GeneralUtility::trimExplode(',', $typoScriptSettings['settings']['overrideFlexformSettingsIfEmpty'], TRUE);
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
	 * Return logged in frontend user, if any, NULL otherwise
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 */
	protected function getLoggedInFrontendUser() {
	    /** @var FrontendUser $frontendUser */
	    $frontendUser = NULL;
	    $user = $GLOBALS['TSFE']->fe_user->user;
	    if(isset($user['uid'])) {
	        $frontendUser = $this->frontendUserRepository->findByUid($user['uid']);
	    }
	    if(is_null($frontendUser)) {
	        if($this->settings['pidsLogin']) {
                $this->redirectToUri($this->buildPageLink($this->settings['pidsLogin'], TRUE));
            } else {
                throw new Exception('PidLogin not set. Cannot redirect.', '1508229013');
            }
	    }
	    return $frontendUser;
	}

	protected function localize($key, array $arguments = []){
	    return LocalizationUtility::translate($key,$this->request->getControllerExtensionKey(),$arguments);
    }

    /**
     * builds a link to plain page with given uid
     *
     * @param integer $pageUid uid of the page to link to
     * @param bool $addReturnUrl add return_url parameter to link
     * @return string the uri to link to
     */
    protected function buildPageLink($pageUid, $addReturnUrl = FALSE) {
        $this->uriBuilder->reset();
        $this->uriBuilder->setTargetPageUid(intval($pageUid));
        if($addReturnUrl) {
            /** @noinspection NullPointerExceptionInspection */
            $this->uriBuilder->setArguments(array('return_url' => $this->uriBuilder->getRequest()->getRequestUri()));
        }
        return $this->uriBuilder->build();
    }



}
