<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
if (!defined('TYPO3')) {
    die ('Access denied.');
}
call_user_func(function ($packageKey) {
    ExtensionManagementUtility::addStaticFile($packageKey, 'Configuration/TypoScript', 'Address Management');
    ExtensionManagementUtility::addStaticFile($packageKey, 'Configuration/TypoScript/BasicCss', 'Address Management Basic CSS');
}, 'addressmgmt');

