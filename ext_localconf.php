<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Undkonsorten.' . $_EXTKEY,
	'List',
	array(
		'Address' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Address' => '',
		
	)
);

?>