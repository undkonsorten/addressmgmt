<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$extensionConfiguration = \Undkonsorten\Addressmgmt\Service\ExtensionConfigurationService::getInstance('addressmgmt');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Undkonsorten.addressmgmt',
	'List',
	array(
		'Address' => 'list, show',
        'File'  => '',

	),
	// non-cacheable actions
	array(
		'Address' => 'new, create, edit, update, delete',
	    'Address' => 'dash, edit, create, new, update, handInForReview',
	    'File'	 => 'edit, update, new, create, delete',
	    'SocialIdentifier' => 'create, delete, update, edit'

	)
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'<INCLUDE_TYPOSCRIPT: source="FILE:EXT:addressmgmt/Configuration/TsConfig/TemplateLayout.ts">'
);

$rootCategory = $extensionConfiguration->getProperty('rootCategory');
$pageTsConfig = sprintf(
		'TCEFORM.tt_content.pi_flexform.addressmgmt_list.sDEF.settings\.category.config.treeConfig.rootUid = %d' . PHP_EOL,
		$rootCategory
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig($pageTsConfig);

?>
