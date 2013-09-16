<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_people_domain_model_person'] = array(
	'ctrl' => $TCA['tx_people_domain_model_person']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, lst_name, gender, title, organization, department, street, street_number, address_supplement, city, zip, country, state, closest_city, email, phone, mobile, fax, www, description, image, latitude, longitude, fe_user, social_identifiers',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, first_name, lst_name, gender, title, organization, department, street, street_number, address_supplement, city, zip, country, state, closest_city, email, phone, mobile, fax, www, description, image, latitude, longitude, fe_user, social_identifiers,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_people_domain_model_person',
				'foreign_table_where' => 'AND tx_people_domain_model_person.pid=###CURRENT_PID### AND tx_people_domain_model_person.sys_language_uid IN (-1,0)',
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
		'first_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'lst_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.lst_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'gender' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.gender',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'organization' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.organization',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'department' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.department',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'street' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.street',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'street_number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.street_number',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'address_supplement' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.address_supplement',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.country',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'state' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.state',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'closest_city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.closest_city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'phone' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.phone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'mobile' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.mobile',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'fax' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.fax',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'www' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.www',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.image',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file_reference',
				'uploadfolder' => 'uploads/tx_people',
				'allowed' => '*',
				'disallowed' => 'php',
				'size' => 5,
			),
		),
		'latitude' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.latitude',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'longitude' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.longitude',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'fe_user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.fe_user',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'social_identifiers' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.social_identifiers',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_people_domain_model_socialidentifier',
				'foreign_field' => 'person',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
	),
);

?>