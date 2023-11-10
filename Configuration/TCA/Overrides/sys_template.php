<?php
if (!defined('TYPO3')) {
    die ('Access denied.');
}
call_user_func(function ($packageKey) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($packageKey, 'Configuration/TypoScript', 'Address Management');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($packageKey, 'Configuration/TypoScript/BasicCss', 'Address Management Basic CSS');
}, 'addressmgmt');

