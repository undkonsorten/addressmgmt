<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_addressmgmt_domain_model_relation'] = array(
	'ctrl' => $TCA['tx_addressmgmt_domain_model_relation']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'location, room',
	),
	'types' => array(
		'1' => array('showitem' => 'location, room'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_addressmgmt_domain_model_relation',
				'foreign_table_where' => 'AND tx_addressmgmt_domain_model_relation.pid=###CURRENT_PID### AND tx_addressmgmt_domain_model_relation.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'room' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_relation.room',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_addressmgmt_domain_model_room',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1,
				    'newRecordLinkAddTitle' => TRUE,
				),
			),
		),
		'location' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_relation.location',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_addressmgmt_domain_model_address',
			    'foreign_table_where' => 'AND tx_addressmgmt_domain_model_address.type = \'Tx_Addressbook_Location\'',
				'minitems' => 0,
				'maxitems' => 1,
			    'wizards' => array(
	                '_PADDING' => 1,
	                'edit' => array(
	                    'type' => 'popup',
	                    'title' => 'Edit',
	                    'script' => 'wizard_edit.php',
	                    'icon' => 'edit2.gif',
	                    'popup_onlyOpenIfSelected' => 1,
	                    'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
	                ),
	                'add' => Array(
	                    'type' => 'script',
	                    'title' => 'Create new',
	                    'icon' => 'EXT:t3skin/icons/gfx/new_record.gif',
	                    'params' => array(
	                        'table' => 'tx_addressmgmt_domain_model_address',
	                        'pid' => '###CURRENT_PID###',
	                        'setValue' => 'prepend'
	                    ),
	                    'script' => 'wizard_add.php',
	                    ),
	                'suggest' => array(
	                    'type' => 'suggest',
	                ),
	            ),
			),
		),
		
	),
);