<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tca = [
    'ctrl' => [
        'title'	=> 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_link',
        'label' => 'text',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
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
        'searchFields' => 'text,link,',
        'iconfile' =>'EXT:addressmgmt/Resources/Public/Icons/tx_addressmgmt_domain_model_link.png'
    ],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, text, link',
    ],
	'types' => [
		'1' => ['showitem' => 'text, link,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, starttime, endtime'],
    ],
	'palettes' => [
		'1' => ['showitem' => ''],
    ],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => [
					['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
					['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
            ],
        ],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'items' => [
					['', 0],
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
		't3ver_label' => [
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
            ]
        ],
		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
            ],
        ],
		'starttime' => [
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
		'endtime' => [
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
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
	            'type' => 'input',
	            'size' => '50',
	            'max' => '256',
	            'eval' => 'trim',
	            'wizards' => [
	                '_PADDING' => 2,
	                'link' => [
	                    'type' => 'popup',
	                    'title' => 'LLL:EXT:cms/locallang_ttc.xml:header_link_formlabel',
	                    'icon' => 'actions-document-new',
						'module' => [
							'name' => 'wizard_element_browser',
							'urlParameters' => [
								'mode' => 'wizard'
                            ]
                        ],
	                    'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
                    ],
                ],
	            'softref' => 'typolink',
            ],
        ],
    ],
];
if( \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version()) < 7000000){
    $tca['columns']['link']['config']['wizards']['link']['icon'] = 'link_popup.gif';
}
return $tca;