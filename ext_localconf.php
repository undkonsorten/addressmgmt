<?php
use Undkonsorten\Addressmgmt\Service\ExtensionConfigurationService;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Undkonsorten\Addressmgmt\Controller\AddressController;
use Undkonsorten\Addressmgmt\Controller\FileController;
use Undkonsorten\Addressmgmt\Controller\SocialIdentifierController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
if (!defined('TYPO3')) {
	die ('Access denied.');
}

$extensionConfiguration = ExtensionConfigurationService::getInstance('addressmgmt');

ExtensionUtility::configurePlugin(
	'Addressmgmt',
	'List',
	array(
		AddressController::class => 'list, show',
        FileController::class  => '',

	),
	// non-cacheable actions
	array(
		AddressController::class => 'new, create, edit, update, delete, dash, handInForReview',
	    FileController::class	 => 'edit, update, new, create, delete'
	)
);

ExtensionManagementUtility::addPageTSConfig(
		'<INCLUDE_TYPOSCRIPT: source="FILE:EXT:addressmgmt/Configuration/TsConfig/TemplateLayout.ts">'
);

$rootCategory = $extensionConfiguration['rootCategory'];
$pageTsConfig = sprintf(
		'TCEFORM.tt_content.pi_flexform.addressmgmt_list.sDEF.settings\.category.config.treeConfig.rootUid = %d' . PHP_EOL,
		$rootCategory
);
ExtensionManagementUtility::addPageTSConfig($pageTsConfig);

