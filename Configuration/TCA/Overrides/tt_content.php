<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
defined('TYPO3') or die();

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['addressmgmt_list'] = 'select_key';

$extensionKey = 'addressmgmt';
$pluginSignature = str_replace('_','',$extensionKey) . '_list';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
/** @noinspection PhpFullyQualifiedNameUsageInspection */
ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$extensionKey.'/Configuration/FlexForms/flexform_list.xml');
