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
    []
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Show',
    [
        AddressController::class => 'show',
    ],
    []
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Create',
    [
        AddressController::class => 'new, create, dash',
    ],
    [
        AddressController::class => 'new, create, dash',
    ]
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Edit',
    [
        AddressController::class => 'new, create, edit, update, dash',
    ],
    [
        AddressController::class => 'new, create, edit, update, dash',
    ]
);
ExtensionUtility::configurePlugin(
    'Addressmgmt',
    'Dash',
    [
        AddressController::class => 'dash, edit, update, new, create, handInForReview, delete, remove',
        SocialIdentifier::class => 'create, delete, update, edit',
        FileController::class => 'edit, update, new, create, delete, '
    ],
    [
        AddressController::class => 'new, create, dash',
        FileController::class => 'edit, update, new, create, delete, ',
        SocialIdentifier::class => 'create, delete, update, edit',
    ]
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['txAddressmgmtPluginUpdater'] = \Undkonsorten\Addressmgmt\Updates\PluginUpdater::class;

