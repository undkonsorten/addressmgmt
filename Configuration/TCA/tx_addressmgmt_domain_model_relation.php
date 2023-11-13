<?php
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
if (!defined ('TYPO3')) {
    die ('Access denied.');
}

$tca = [
    'ctrl' => [
        'title'	=> 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_relation',
        'label' => 'location, room',
        'label_alt' => 'location, room',
        'label_alt_force' => TRUE,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => TRUE,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'room,location,',
        'iconfile' => 'EXT:addressmgmt/Resources/Public/Icons/tx_addressmgmt_domain_model_relation.png'
    ],
	'interface' => [
		'showRecordFieldList' => 'location, room',
    ],
	'types' => [
		'1' => ['showitem' => 'location, room'],
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
				'foreign_table' => 'tx_addressmgmt_domain_model_relation',
				'foreign_table_where' => 'AND tx_addressmgmt_domain_model_relation.pid=###CURRENT_PID### AND tx_addressmgmt_domain_model_relation.sys_language_uid IN (-1,0)',
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
                'dbType' => 'datetime',
                'eval' => 'datetime',
            ],
        ],

		'room' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_relation.room',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_addressmgmt_domain_model_room',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => [
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1,
				    'newRecordLinkAddTitle' => TRUE,
                ],
            ],
        ],
		'location' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_relation.location',
			'config' => [
				'type' => 'select',
                'renderType' => 'selectSingle',
				'foreign_table' => 'tx_addressmgmt_domain_model_address',
			    'foreign_table_where' => 'AND tx_addressmgmt_domain_model_address.type = \'Tx_Addressbook_Location\'',
				'minitems' => 0,
				'maxitems' => 1,
                'fieldControl' => [
                    'addRecord' => [
                        'options' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.createNew',
                            'table' => 'tx_addressmgmt_domain_model_address',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ],
                    ],
                    'editPopup' => [
                        'disabled' => false,
                        'options' => [
                            'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.edit',
                            'windowOpenParameters' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                        ]
                    ]
                ]
            ],
        ],

    ],
];
if( VersionNumberUtility::convertVersionNumberToInteger(VersionNumberUtility::getNumericTypo3Version()) < 7000000){
    $tca['columns']['location']['config']['wizards']['add']['icon'] = 'EXT:t3skin/icons/gfx/new_record.gif';
    $tca['columns']['location']['config']['wizards']['edit']['icon'] = 'edit2.gif';

}

return $tca;
