<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}
$tca = [
    'ctrl' => [
        'title'	=> 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_room',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => TRUE,
        'hideTable' => TRUE,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'name,',
        'iconfile' => 'EXT:addressmgmt/Resources/Public/Icons/tx_addressmgmt_domain_model_room.png',
    ],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, name, capacity, description',
    ],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, name, capacity, description'],
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
				'foreign_table' => 'tx_addressmgmt_domain_model_room',
				'foreign_table_where' => 'AND tx_addressmgmt_domain_model_room.pid=###CURRENT_PID### AND tx_addressmgmt_domain_model_room.sys_language_uid IN (-1,0)',
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
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_room.name',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
	    'capacity' => [
	        'exclude' => 1,
	        'allowLanguageSynchronization' => true,
	        'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_room.capacity',
	        'config' => [
	            'type' => 'input',
	            'size' => 13,
	            'max' => 20,
	            'eval' => 'int',
	            'checkbox' => 0,
	            'default' => 0,
            ],
        ],
	    'description' => [
	        'exclude' => 1,
	        'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_room.description',
	        'config' => [
	            'type' => 'text',
	            'cols' => 40,
	            'rows' => 10,
	            'eval' => 'trim',
            ],
        ],

    ],
];

return $tca;
