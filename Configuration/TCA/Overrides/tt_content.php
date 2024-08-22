<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

$pluginConfig = ['dash', 'edit', 'create', 'show', 'list'];
foreach ($pluginConfig as $pluginName) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Addressmgmt',
        \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($pluginName),
        'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:plugin.' . $pluginName . '.title',
        'ext-addressmgmt-plugin-'.$pluginName.'-icon',
        'addressmgmt'
    );

    $contentTypeName = 'addressmgmt_' . str_replace('_', '', $pluginName);

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        '*',
        'FILE:EXT:addressmgmt/Configuration/FlexForms/flexform_' . $pluginName . '.xml',
        $contentTypeName
    );
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$contentTypeName] = 'ext-addressmgmt-plugin-' . $pluginName . '-icon';
    $GLOBALS['TCA']['tt_content']['types'][$contentTypeName]['showitem'] = '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.plugin,
            pi_flexform,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
            --palette--;;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ';
}
ExtensionManagementUtility::addToInsertRecords('tx_addressmgmt_domain_model_address');
