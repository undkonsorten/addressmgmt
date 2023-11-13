<?php
if (!defined ('TYPO3')) {
	die ('Access denied.');
}

$tca = [
    'ctrl' => [
        'title'	=> 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialidentifier',
        'label' => 'identifier',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'hideTable' => TRUE,
        'label_alt' => 'provider',
        'label_alt_force' => TRUE,
        'sortby' => 'sorting',
        'versioningWS' => TRUE,
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
        'searchFields' => 'identifier,url_override,provider,',
        'iconfile' =>'EXT:addressmgmt/Resources/Public/Icons/tx_addressmgmt_domain_model_relation.png'
    ],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, identifier, url_override, provider',
    ],
	'types' => [
		'1' => ['showitem' => 'hidden, --palette--;;1, identifier, --palette--;;url_override, provider'],
    ],
	'palettes' => [
		'url_override' => ['showitem' => 'url_override', 'canNotCollapse' => 1],
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
				'foreign_table' => 'tx_addressmgmt_domain_model_socialidentifier',
				'foreign_table_where' => 'AND tx_addressmgmt_domain_model_socialidentifier.pid=###CURRENT_PID### AND tx_addressmgmt_domain_model_socialidentifier.sys_language_uid IN (-1,0)',
            ],
        ],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
            ],
        ],
		't3ver_label' => [
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
            ]
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
				'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ],
        ],
		'endtime' => [
			'exclude' => 1,
			'allowLanguageSynchronization' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
            ],
        ],
		'identifier' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialidentifier.identifier',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
    'required' => true
            ],
        ],
		'url_override' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialidentifier.url_override',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'provider' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialidentifier.provider',
			'config' => [
				'type' => 'select',
			    'renderType' => 'selectSingle',
				'foreign_table' => 'tx_addressmgmt_domain_model_socialprovider',
				'minitems' => 0,
				'maxitems' => 1,
				'wizards' => [
					'suggest' => [
						'type' => 'suggest',
                    ],
                ],
            ],
        ],
		'address' => [
			'config' => [
				'type' => 'passthrough',
            ],
        ],
    ],
];

return $tca;

