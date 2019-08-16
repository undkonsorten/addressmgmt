<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'List',
	'Address Management'
);

$pluginSignature = str_replace('_','',$_EXTKEY) . '_list';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_address', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressmgmt_domain_model_address.xlf');

// Need pid in fe_user to be able to move records from FE
$frontendUserColumns = array(
	'pid' => array(
		'config' => array(
			'type' => 'passthrough',
		),
	),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$frontendUserColumns,1);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_address');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_socialidentifier', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressmgmt_domain_model_socialidentifier.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_socialidentifier');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_socialprovider', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressmgmt_domain_model_socialprovider.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_socialprovider');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_link', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressmgmt_domain_model_link.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_link');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_relation', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressmgmt_domain_model_relation.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_relation');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_room', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressmgmt_domain_model_room.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_room');

if( \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version()) < 7000000){
    $TCA['tx_addressmgmt_domain_model_room']['ctrl']['iconfile'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Public/Icons/tx_addressmgmt_domain_model_room.png';
    $TCA['tx_addressmgmt_domain_model_relation']['ctrl']['iconfile'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Public/Icons/tx_addressmgmt_domain_model_relation.png';
    $TCA['tx_addressmgmt_domain_model_link']['ctrl']['iconfile'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Public/Icons/tx_addressmgmt_domain_model_link.png';
    $TCA['tx_addressmgmt_domain_model_socialprovider']['ctrl']['iconfile'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Public/Icons/tx_addressmgmt_domain_model_socialprovider.png';
    $TCA['tx_addressmgmt_domain_model_socialidentifier']['ctrl']['iconfile'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Public/Icons/tx_addressmgmt_domain_model_relation.png';
    $TCA['tx_addressmgmt_domain_model_address']['ctrl']['iconfile'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Public/Icons/tx_addressmgmt_domain_model_address.png';
}

?>
