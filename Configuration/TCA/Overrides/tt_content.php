<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['addressmgmt_list'] = 'recursive,select_key,pages';

$extensionKey = 'addressmgmt';
$pluginSignature = str_replace('_','',$extensionKey) . '_list';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$extensionKey.'/Configuration/FlexForms/flexform_list.xml');
