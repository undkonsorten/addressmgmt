<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_people_domain_model_person'] = array(
	'ctrl' => $TCA['tx_people_domain_model_person']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, last_name, gender, title, organization, department, street, street_number, address_supplement, city, zip, country, state, closest_city, email, phone, mobile, fax, www, description, image, latitude, longitude, fe_user, social_identifiers',
	),
	'types' => array(
		'1' => array('showitem' => '
					--palette--;Name;name, fe_user, organization;;department, 
					--palette--;Personal contact;personal_contact,social_identifiers,
					--div--;Description,image,description,  
					--div--;Address,
					--palette--;Address;address,
					--palette--;Coordinates;coordinates,
					--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
					sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden, starttime, endtime,  
				'
		),
	),
	'palettes' => array(
		'name' => array('showitem' => 'gender, title, --linebreak--, first_name, last_name', 'canNotCollapse' => 1),
		'department' => array('showitem' => 'department', 'canNotCollapse' => 1),
		'address' => array('showitem' => 'street, street_number, address_supplement, --linebreak--, zip, city, --linebreak--, state, country', 'canNotCollapse' => 1),
		'coordinates' => array('showitem' => 'closest_city, --linebreak--, longitude, latitude', 'canNotCollapse' => 1),
		'personal_contact' => array('showitem' => 'email, www, --linebreak--, phone, mobile, fax', 'canNotCollapse' => 1),
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
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'last_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.last_name',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim,required'
			),
		),
		'gender' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.gender',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('--', 0),
					array('Ma\'am', 1),
					array('Sir', 2),
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
				'size' => 10,
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
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'street' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.street',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			),
		),
		'street_number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.street_number',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'trim'
			),
		),
		'address_supplement' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.address_supplement',
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.city',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.zip',
			'config' => array(
				'type' => 'input',
				'size' => 6,
				'eval' => 'trim'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.country',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'state' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.state',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'closest_city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.closest_city',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.email',
			'config' => array(
				'type' => 'input',
				'size' => 25,
				'eval' => 'trim'
			),
		),
		'phone' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.phone',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'trim'
			),
		),
		'mobile' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.mobile',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'trim'
			),
		),
		'fax' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.fax',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'www' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.www',
			'config' => array(
				'type' => 'input',
				'size' => 20,
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
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image', 
				array(
					'appearance' => array(
							'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
					),
					'foreign_types' => array(
						'0' => array(
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
								'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
					),
									
				), 
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'latitude' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.latitude',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'longitude' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.longitude',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'fe_user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.fe_user',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
				'size' => 1,
				'items' => array(
					array('none' => ''),
				),
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
					),
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

$settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['people']);
if(!$settings['feUserRelation']) {
	$TCA['tx_people_domain_model_person']['columns']['fe_user'] = array(
		'exclude' => 1,
		'label' => 'LLL:EXT:people/Resources/Private/Language/locallang_db.xlf:tx_people_domain_model_person.fe_user',
		'config' => array(
			'type' => 'passthrough',
		),
	);
}
?>