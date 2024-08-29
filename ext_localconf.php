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
    ],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Show',
    [
        AddressController::class => 'show',
    ],
    [],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Create',
    [
        AddressController::class => 'new, create, dash',
    ],
    [
        AddressController::class => 'new, create, dash',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Edit',
    [
        AddressController::class => 'new, create, edit, update, dash',
    ],
    [
        AddressController::class => 'new, create, edit, update, dash',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Dash',
    [
        AddressController::class => 'dash, edit, update, new, create, handInForReview, delete, remove',
        SocialIdentifier::class => 'create, delete, update, edit',
        FileController::class  => 'edit, update, new, create, delete, '
    ],
    [
        AddressController::class => 'new, create, dash',
        FileController::class  => 'edit, update, new, create, delete, ',
        SocialIdentifier::class => 'create, delete, update, edit',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionManagementUtility::addPageTSConfig(
    '
	@import \'EXT:addressmgmt/Configuration/TsConfig/TemplateLayout.page.typoscript\'>
    @import \'EXT:addressmgmt/Configuration/TsConfig/ContentElementWizard.page.typoscript\'
    '
);

$rootCategory = $extensionConfiguration->getProperty('rootCategory');
$pageTsConfig = sprintf(
		'TCEFORM.tt_content.pi_flexform.addressmgmt_list.sDEF.settings\.category.config.treeConfig.rootUid = %d' . PHP_EOL,
		$rootCategory
);
ExtensionManagementUtility::addPageTSConfig($pageTsConfig);
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['txAddressmgmtPluginUpdater'] = \Undkonsorten\Addressmgmt\Updates\PluginUpdater::class;

