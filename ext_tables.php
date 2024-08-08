<?php
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
if (!defined('TYPO3')) {
	die ('Access denied.');
}

ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_address', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressbook_domain_model_address.xlf');

// Need pid in fe_user to be able to move records from FE
$frontendUserColumns = array(
	'pid' => array(
		'config' => array(
			'type' => 'passthrough',
		),
	),
);
ExtensionManagementUtility::addTCAcolumns('fe_users',$frontendUserColumns);

ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_address');


ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_socialidentifier', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressbook_domain_model_socialidentifier.xlf');
ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_socialidentifier');

ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_socialprovider', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressbook_domain_model_socialprovider.xlf');
ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_socialprovider');

ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_link', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressbook_domain_model_link.xlf');
ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_link');

ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_relation', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressbook_domain_model_relation.xlf');
ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_relation');

ExtensionManagementUtility::addLLrefForTCAdescr('tx_addressmgmt_domain_model_room', 'EXT:addressmgmt/Resources/Private/Language/locallang_csh_tx_addressbook_domain_model_room.xlf');
ExtensionManagementUtility::allowTableOnStandardPages('tx_addressmgmt_domain_model_room');
