<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$settings = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['addressmgmt'];
$tca = [
    'ctrl' => [
        'type' => 'type',
        'title'	=> 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address',
        'label' => 'name',
        'label_alt' => 'first_name',
        'label_alt_force' => TRUE,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'default_sortby' => 'name',

        'versioningWS' => true,
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
        'searchFields' => 'first_name,name,gender,title,organization,department,street,street_number,address_supplement,city,zip,country,state,closest_city,email,phone,mobile,fax,www,description,image,latitude,longitude,fe_user,social_identifiers,',
        'iconfile' =>'EXT:addressmgmt/Resources/Public/Icons/tx_addressmgmt_domain_model_address.png'
    ],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, name, gender, title, organization, department, street, street_number, address_supplement, city, zip, country, state, closest_city, email, phone, mobile, fax, www, description, images, latitude, longitude, geojson, fe_user, social_identifiers, publish_state',
    ],
	'types' => [
	   '0' => [
           'showitem' => '
				type,
			'
       ],
		'Tx_Addressbook_Person' => [
            'showitem' => '
				type,--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.name;name, fe_user, organization,--palette--;;department,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.addressal_contact;addressal_contact, category, social_identifiers, publish_state,
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.description,images,description,
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address;address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.coordinates;coordinates,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
				sys_language_uid, l10n_parent, l10n_diffsource, hidden, starttime, endtime,
			'
        ],
		'Tx_Addressbook_Organisation' => [
            'showitem' => '
				type, name,--palette--;;department, fe_user, organization,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.addressal_contact;addressal_contact, category, social_identifiers, publish_state,
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.description,images,description,
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address;address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.coordinates;coordinates,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
				sys_language_uid, l10n_parent, l10n_diffsource, hidden, starttime, endtime,
			'
        ],
	    'Tx_Addressbook_Location' => [
            'showitem' => '
				type, name,--palette--;;department, fe_user, organization,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.addressal_contact;addressal_contact, counterpart, category, social_identifiers, publish_state,
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.description,images,description,
			--div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.address;address,
				--palette--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.coordinates;coordinates,
	        --div--;LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.tce.rooms,
				--palette--;;rooms,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
				sys_language_uid, l10n_parent, l10n_diffsource, hidden, starttime, endtime,
			'
        ],
    ],
	'palettes' => [
		'name' => ['showitem' => 'gender, title, --linebreak--, first_name, name', 'canNotCollapse' => 1],
		'department' => ['showitem' => 'department', 'canNotCollapse' => 1],
		'additional_organisation' => ['showitem' => 'organisation', 'canNotCollapse' => 1],
		'address' => ['showitem' => 'street, street_number, address_supplement, --linebreak--, zip, city, --linebreak--, state, country, --linebreak--, directions', 'canNotCollapse' => 1],
		'coordinates' => ['showitem' => 'closest_city, --linebreak--, latitude, longitude, map_zoom, geojson', 'canNotCollapse' => 1],
		'addressal_contact' => ['showitem' => 'email ,--linebreak--, www, --linebreak--, phone, mobile, fax', 'canNotCollapse' => 1],
	    'rooms' => ['showitem' => 'relation','canNotCollapse' => 1],
    ],
	'columns' => [
		'pid' => [
			'config' => [
				'type' => 'passthrough',
            ],
        ],
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
				'foreign_table' => 'tx_addressmgmt_domain_model_address',
				'foreign_table_where' => 'AND tx_addressmgmt_domain_model_address.pid=###CURRENT_PID### AND tx_addressmgmt_domain_model_address.sys_language_uid IN (-1,0)',
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
		'type' => [
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.type',
			'config' => [
				'type' => 'select',
			    'renderType' => 'selectSingle',
				'default' => '',
				'items' => [
				    ['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.choose_type', '0'],
					['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.type_person', 'Tx_Addressbook_Person'],
					['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.type_organisation', 'Tx_Addressbook_Organisation'],
				    ['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.type_location', 'Tx_Addressbook_Location'],
                ],
            ],
        ],
		'first_name' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.first_name',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
            ],
        ],
		'name' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.name',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required'
            ],
        ],
		'gender' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.gender',
			'config' => [
				'type' => 'select',
			    'renderType' => 'selectSingle',
				'items' => [
					['', ''],
					['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.1', 1],
					['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.2', 2],
					['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.3', 3],
                ],
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
            ],
        ],
		'title' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.title',
			'config' => [
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
            ],
        ],
		'organization' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.organization',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'department' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.department',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
            ],
        ],
		'street' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.street',
			'config' => [
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
            ],
        ],
		'street_number' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.street_number',
			'config' => [
				'type' => 'input',
				'size' => 4,
				'eval' => 'trim'
            ],
        ],
		'address_supplement' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.address_supplement',
			'config' => [
				'type' => 'input',
				'size' => 8,
				'eval' => 'trim'
            ],
        ],
		'city' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.city',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
            ],
        ],
		'zip' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.zip',
			'config' => [
				'type' => 'input',
				'size' => 6,
				'eval' => 'trim'
            ],
        ],
		'country' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.country',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
            ],
        ],
		'state' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.state',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
            ],
        ],
		'closest_city' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.closest_city',
			'config' => [
				'type' => 'input',
				'size' => 15,
				'eval' => 'trim'
            ],
        ],
		'email' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.email',
			'config' => [
				'type' => 'input',
				'size' => 25,
				'eval' => 'trim'
            ],
        ],
		'phone' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.phone',
			'config' => [
				'type' => 'input',
				'size' => 12,
				'eval' => 'trim'
            ],
        ],
		'mobile' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.mobile',
			'config' => [
				'type' => 'input',
				'size' => 12,
				'eval' => 'trim'
            ],
        ],
		'fax' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.fax',
			'config' => [
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim'
            ],
        ],
		'www' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.www',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_addressmgmt_domain_model_link',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => [
					'levelLinksPosition' => 'top',
					'collapseAll' => TRUE,
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
                ],
            ],
        ],
	    'counterpart' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.counterpart',
			'config' => [
				'type' => 'text',
					'cols' => 20,
				    'rows' => 5,
				'eval' => 'trim'
            ],
        ],
		'description' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.description',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 10,
				'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
	    'directions' => [
	        'exclude' => 1,
	        'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.directions',
	        'config' => [
	            'type' => 'text',
	            'cols' => 40,
	            'rows' => 15,
	            'eval' => 'trim',
                'enableRichtext' => true,
            ],
        ],
		'images' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				[
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
		'latitude' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.latitude',
			'config' => [
				'type' => 'input',
				'size' => 10,
				'eval' => 'Undkonsorten\Addressmgmt\Utility\Evaluation\Coordinate'
            ],
        ],
		'longitude' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.longitude',
			'config' => [
				'type' => 'input',
				'size' => 10,
				'eval' => 'Undkonsorten\Addressmgmt\Utility\Evaluation\Coordinate'
            ],
        ],
        'publish_state' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.publish_state',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', ''],
                    ['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.publish_state.0', \Undkonsorten\Addressmgmt\Domain\Model\Address::PUBLISH_CREATED],
                    ['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.publish_state.1', \Undkonsorten\Addressmgmt\Domain\Model\Address::PUBLISH_WAITING],
                    ['LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.publish_state.2', \Undkonsorten\Addressmgmt\Domain\Model\Address::PUBLISH_PUBLISHED],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
	    'geojson' => [
	        'exclude' => 1,
	        'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.geojson',
	        'config' => [
	            'type' => 'text',
            ],
        ],
		'fe_user' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.fe_user',
			'config' => [
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'fe_users',
				'size' => 1,
				'prepend_tname' => FALSE,
				'minitems' => 0,
				'maxitems' => 1,
                'fieldControl' => [
                    'addRecord' => [
                        'options' => [
                            'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.createNew',
                            'table' => 'fe_users',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ],
                    ],
                    'editPopup' => [
                        'disabled' => false,
                        'options' => [
                            'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.edit',
                            'windowOpenParameters' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                        ]
                    ]
                ]
            ],
        ],
		'category' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.category',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectTree',
                'foreign_table' => 'sys_category',
                'foreign_table_where' => 'AND sys_category.hidden=0 AND sys_category.sys_language_uid IN (-1,0)',
                'renderMode' => 'tree',
                'treeConfig' => [
                        'parentField' => 'parent',
                        'rootUid' => $settings['rootCategory'],
                        'appearance' => [
                                'expandAll' => TRUE,
                                'showHeader' => TRUE,
                        ],
                ],
                'MM' => 'tx_addressmgmt_address_category_mm',
                'size' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'addRecord' => [
                        'options' => [
                            'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.createNew',
                            'table' => 'fe_users',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ],
                    ],
                ]
            ],
        ],

		'social_identifiers' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.social_identifiers',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_addressmgmt_domain_model_socialidentifier',
				'foreign_field' => 'address',
				'maxitems'      => 9999,
				'appearance' => [
					'expandSingle' => TRUE,
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1,
                ],
            ],
        ],
		'map_zoom' => [
				'exclude' => 1,
				'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.map_zoom',
				'config' => [
						'type' => 'input',
						'size' => 10,
						'eval' => 'num,null',
                ],
        ],
	    'relation' => [
	        "exclude" => 1,
	        "label" => "LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.relation",
	        "l10n_mode" => "exclude",
	        "config" => [
	            'type' => 'inline',
	            'foreign_table' => 'tx_addressmgmt_domain_model_relation',
	            'foreign_field' => 'location',
	            'foreign_label' => 'room',
	            'appearance' => [
	                'collapseAll' => 1,
	                'expandSingle' => 1,
	                'newRecordLinkAddTitle' => TRUE,
                ],
            ],
        ],
    ],
];

if(!$settings['feUserRelation']) {
	$TCA['tx_addressmgmt_domain_model_address']['columns']['fe_user'] = array(
		'exclude' => 1,
		'label' => 'LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt_domain_model_address.fe_user',
		'config' => array(
			'type' => 'passthrough',
		),
	);
}

return $tca;

