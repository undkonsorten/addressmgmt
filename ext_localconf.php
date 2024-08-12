<?php

use Undkonsorten\Addressmgmt\Domain\Model\SocialIdentifier;
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
	[
		AddressController::class => 'list, show',
        FileController::class  => '',

    ],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Show',
    [
        AddressController::class => 'show',
        FileController::class  => '',

    ],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Create',
    [
        AddressController::class => 'new, create, dash',
        FileController::class  => '',

    ],
    [
        AddressController::class => 'new, create, dash',
        FileController::class  => '',

    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Edit',
    [
        AddressController::class => 'edit, update, dash',
        FileController::class  => '',

    ],
    [
        AddressController::class => 'new, create, dash',
        FileController::class  => '',

    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Dash',
    [
        AddressController::class => 'dash, edit, update, new, create, handInForReview, delete, remove',
        FileController::class  => 'edit, update, new, create, delete, ',
        SocialIdentifier::class => 'create, delete, update, edit'

    ],
    [
        AddressController::class => 'new, create, dash',
        FileController::class  => '',

    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionManagementUtility::addPageTSConfig(
		'<INCLUDE_TYPOSCRIPT: source="FILE:EXT:addressmgmt/Configuration/TsConfig/TemplateLayout.ts">'
);

$rootCategory = $extensionConfiguration->getProperty('rootCategory');
$pageTsConfig = sprintf(
		'TCEFORM.tt_content.pi_flexform.addressmgmt_list.sDEF.settings\.category.config.treeConfig.rootUid = %d' . PHP_EOL,
		$rootCategory
);
ExtensionManagementUtility::addPageTSConfig($pageTsConfig);
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['txAddressmgmtPluginUpdater'] = \Undkonsorten\Addressmgmt\Updates\PluginUpdater::class;

