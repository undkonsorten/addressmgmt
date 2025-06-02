<?php

use TYPO3\CMS\Core\Utility\VersionNumberUtility;

if (!defined('TYPO3')) {
    die ('Access denied.');
}

$tca = [
    'ctrl' => [
        'title' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_link',
        'label' => 'text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',

        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'searchFields' => 'text,link,',
        'iconfile' => 'EXT:addressmgmt/Resources/Public/Icons/tx_addressmgmt_domain_model_link.png'
    ],
    'types' => [
        '1' => ['showitem' => 'text, link,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,sys_language_uid, l10n_parent, l10n_diffsource, hidden,--palette--;;1, starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language'],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_addressmgmt_domain_model_link',
                'foreign_table_where' => 'AND tx_addressmgmt_domain_model_link.pid=###CURRENT_PID### AND tx_addressmgmt_domain_model_link.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'allowLanguageSynchronization' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'allowLanguageSynchronization' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'text' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_link.text',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'link' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_link.link',
            'config' => [
                'type' => 'link',
                'size' => '50',
            ],
        ],
    ],
];
if (VersionNumberUtility::convertVersionNumberToInteger(VersionNumberUtility::getNumericTypo3Version()) < 7000000) {
    $tca['columns']['link']['config']['wizards']['link']['icon'] = 'link_popup.gif';
}
return $tca;
