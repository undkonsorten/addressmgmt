<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (!defined('TYPO3')) {
    die ('Access denied.');
}

// Need pid in fe_user to be able to move records from FE
$frontendUserColumns = array(
    'pid' => array(
        'config' => array(
            'type' => 'passthrough',
        ),
    ),
);
ExtensionManagementUtility::addTCAcolumns('fe_users', $frontendUserColumns);
