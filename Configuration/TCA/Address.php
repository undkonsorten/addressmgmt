<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['addressmgmt']);
$TCA['tx_addressmgmt_domain_model_address'] = array(
	'ctrl' => $TCA['tx_addressmgmt_domain_model_address']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, name, gender, title, organization, department, street, street_number, address_supplement, city, zip, country, state, closest_city, email, phone, mobile, fax, www, description, image, latitude, longitude, fe_user, social_identifiers',
	),
	'types' => array(
		'Tx_Addressbook_Person' => array('showitem' => '
				type,--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.name;name, fe_user, organization;;department, 
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.addressal_contact;addressal_contact, category, social_identifiers,
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.description,image,description,  
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address;address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.coordinates;coordinates,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
				sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden, starttime, endtime,  
			'
		),
		'Tx_Addressbook_Organisation' => array('showitem' => '
				type, name;;department, fe_user, organization, 
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.addressal_contact;addressal_contact, category, social_identifiers,
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.description,image,description,  
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address;address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.coordinates;coordinates,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
				sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden, starttime, endtime,  
			'
		),
	),
	'palettes' => array(
		'name' => array('showitem' => 'gender, title, --linebreak--, first_name, name', 'canNotCollapse' => 1),
		'department' => array('showitem' => 'department', 'canNotCollapse' => 1),
		'additional_organisation' => array('showitem' => 'organisation', 'canNotCollapse' => 1),
		'address' => array('showitem' => 'street, street_number, address_supplement, --linebreak--, zip, city, --linebreak--, state, country', 'canNotCollapse' => 1),
		'coordinates' => array('showitem' => 'closest_city, --linebreak--, latitude, longitude, map_zoom', 'canNotCollapse' => 1),
		'addressal_contact' => array('showitem' => 'email,--linebreak--, www, --linebreak--, phone, mobile, fax', 'canNotCollapse' => 1),
	),
	'columns' => array(
		'pid' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
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
				'foreign_table' => 'tx_addressmgmt_domain_model_address',
				'foreign_table_where' => 'AND tx_addressmgmt_domain_model_address.pid=###CURRENT_PID### AND tx_addressmgmt_domain_model_address.sys_language_uid IN (-1,0)',
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
		'type' => array(
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.type',
			'config' => array(
				'type' => 'select',
				'default' => 'Tx_Addressbook_Organisation',
				'suppress_icons' => 1,
				'items' => array(
					array('LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.type_person', 'Tx_Addressbook_Person'),
					array('LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.type_organisation', 'Tx_Addressbook_Organisation'),
				),
			),
		),
		'first_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.name',
			'config' => array(
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required'
			),
		),
		'gender' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.gender',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', ''),
					array('LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.1', 1),
					array('LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.2', 2),
					array('LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.3', 3),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.title',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'organization' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.organization',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'department' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.department',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'street' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.street',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			),
		),
		'street_number' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.street_number',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'trim'
			),
		),
		'address_supplement' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.address_supplement',
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.city',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.zip',
			'config' => array(
				'type' => 'input',
				'size' => 6,
				'eval' => 'trim'
			),
		),
		'country' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.country',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'state' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.state',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'closest_city' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.closest_city',
			'config' => array(
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.email',
			'config' => array(
				'type' => 'input',
				'size' => 25,
				'eval' => 'trim'
			),
		),
		'phone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.phone',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'trim'
			),
		),
		'mobile' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.mobile',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'eval' => 'trim'
			),
		),
		'fax' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.fax',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
			),
		),
		'www' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.www',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_addressmgmt_domain_model_link',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'collapseAll' => TRUE,
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.description',
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
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image', 
				array(
					'maxitems' => 1,
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
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.latitude',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'Undkonsorten\Addressmgmt\Utility\Evaluation\Coordinate'
			),
		),
		'longitude' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.longitude',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'Undkonsorten\Addressmgmt\Utility\Evaluation\Coordinate'
			),
		),
		'fe_user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.fe_user',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'fe_users',
				'size' => 1,
				'prepend_tname' => FALSE,
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
							'table' => 'fe_users',
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
		'category' => array(
				'exclude' => 1,
				'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.category',
				'config' => array(
						'type' => 'select',
						'foreign_table' => 'sys_category',
						'foreign_table_where' => 'AND sys_category.hidden=0 AND sys_category.sys_language_uid IN (-1,0)',
						'renderMode' => 'tree',
						'treeConfig' => array(
								'parentField' => 'parent',
								'rootUid' => $settings['rootCategory'],
								'appearance' => array(
										'expandAll' => TRUE,
										'showHeader' => TRUE,
								),
						),
						'MM' => 'tx_addressmgmt_address_category_mm',
						'size' => 10,
						'autoSizeMax' => 30,
						'maxitems' => 9999,
						'multiple' => 0,
						'wizards' => array(
								'_PADDING' => 1,
								'_VERTICAL' => 1,
								'add' => Array(
										'type' => 'script',
										'title' => 'Create new',
										'icon' => 'EXT:t3skin/icons/gfx/new_record.gif',
										'params' => array(
												'table' => 'sys_category',
												'pid' => '###CURRENT_PID###',
												'setValue' => 'prepend'
										),
										'script' => 'wizard_add.php',
								),
						),
				),
		),
			
			
		'social_identifiers' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.social_identifiers',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_addressmgmt_domain_model_socialidentifier',
				'foreign_field' => 'address',
				'maxitems'      => 9999,
				'appearance' => array(
					'expandSingle' => TRUE,	
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1,
 				),
			),
		),
		'map_zoom' => array(
				'exclude' => 1,
				'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.map_zoom',
				'config' => array(
						'type' => 'input',
						'size' => 10,
						'eval' => 'num,null',
				),
		),
	),
);

$settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['addressmgmt']);
if(!$settings['feUserRelation']) {
	$TCA['tx_addressmgmt_domain_model_address']['columns']['fe_user'] = array(
		'exclude' => 1,
		'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.fe_user',
		'config' => array(
			'type' => 'passthrough',
		),
	);
}
?>
