<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$extensionConfiguration = \Undkonsorten\Addressmgmt\Service\ExtensionConfigurationService::getInstance($_EXTKEY);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Undkonsorten.' . $_EXTKEY,
	'List',
	array(
		'Address' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Address' => '',
		
	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TsConfig/TemplateLayout.ts">'
);

$rootCategory = $extensionConfiguration->getProperty('rootCategory');
$pageTsConfig = sprintf(
		'TCEFORM.tt_content.pi_flexform.addressmgmt_list.sDEF.settings\.category.config.treeConfig.rootUid = %d' . PHP_EOL,
		$rootCategory
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($pageTsConfig);

?>