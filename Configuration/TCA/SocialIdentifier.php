<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_addressbook_domain_model_socialidentifier'] = array(
	'ctrl' => $TCA['tx_addressbook_domain_model_socialidentifier']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, identifier, url_override, provider',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, identifier;;url_override, provider'),
	),
	'palettes' => array(
		'url_override' => array('showitem' => 'url_override', 'canNotCollapse' => 1),
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
				'foreign_table' => 'tx_addressbook_domain_model_socialidentifier',
				'foreign_table_where' => 'AND tx_addressbook_domain_model_socialidentifier.pid=###CURRENT_PID### AND tx_addressbook_domain_model_socialidentifier.sys_language_uid IN (-1,0)',
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
		'identifier' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:addressbook/Resources/Private/Language/locallang_db.xlf:tx_addressbook_domain_model_socialidentifier.identifier',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'url_override' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressbook/Resources/Private/Language/locallang_db.xlf:tx_addressbook_domain_model_socialidentifier.url_override',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'provider' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressbook/Resources/Private/Language/locallang_db.xlf:tx_addressbook_domain_model_socialidentifier.provider',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_addressbook_domain_model_socialprovider',
				'minitems' => 0,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => Array(
						'type' => 'suggest',
					),
				),
			),
		),
		'address' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

?>