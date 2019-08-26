<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tca = [
    'ctrl' => [
        'title'	=> 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
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
        'searchFields' => 'name,url_scheme,www,',
        'iconfile' =>'EXT:addressmgmt/Resources/Public/Icons/tx_addressmgmt_domain_model_socialprovider.png'
    ],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, url_scheme, www, image',
    ],
	'types' => [
		'1' => [
            'showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden,--palette--;;1, name, url_scheme, www, image, 
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:div.naming,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:palette.identifier;identifier, 
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:palette.url_override;url_override, 
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,starttime, endtime'
        ],
    ],
	'palettes' => [
		'identifier' => ['showitem' => 'identifier_label,--linebreak--,identifier_description', 'canNotCollapse' => TRUE],
		'url_override' => ['showitem' => 'show_url_override,--linebreak--,url_override_label,--linebreak--,url_override_description', 'canNotCollapse' => TRUE],
    ],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
			    'renderType' => 'selectSingle',
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
                'renderType' => 'selectSingle',
				'items' => [
					['', 0],
                ],
				'foreign_table' => 'tx_addressmgmt_domain_model_socialprovider',
				'foreign_table_where' => 'AND tx_addressmgmt_domain_model_socialprovider.pid=###CURRENT_PID### AND tx_addressmgmt_domain_model_socialprovider.sys_language_uid IN (-1,0)',
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
			'allowLanguageSynchronization' => true,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
                'renderType' => 'inputDateTime',
                'dbType' => 'datetime',
                'eval' => 'datetime',
            ],
        ],
		'endtime' => [
			'exclude' => 1,
			'allowLanguageSynchronization' => true,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
                'renderType' => 'inputDateTime',
                'dbType' => 'datetime',
                'eval' => 'datetime',
            ],
        ],
		'name' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.name',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
            ],
        ],
		'identifier_label' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.identifier_label',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'identifier_description' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.identifier_description',
			'config' => [
				'type' => 'text',
				'cols' => 30,
				'rows' => 4,
				'eval' => 'trim'
            ],
        ],
		'url_scheme' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.url_scheme',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'url_override_label' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.url_override_label',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'url_override_description' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.url_override_description',
			'config' => [
				'type' => 'text',
				'cols' => 30,
				'rows' => 4,
				'eval' => 'trim'
            ],
        ],
		'show_url_override' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.show_url_override',
			'config' => [
				'type' => 'check',
            ],
        ],
		'www' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.www',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'image' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_socialprovider.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image', 
				[
					'maxitems' => 1,
					'appearance' => [
							'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            '0' => [
                                'showitem' => '
                                    --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                    --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                        ],
                    ],
                ],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
        ],
    ],
];

return $tca;

?>
