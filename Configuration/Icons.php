<?php
declare(strict_types=1);

$iconList = [];
foreach ([
    'dash' => 'PluginDash.svg',
    'edit' => 'PluginEdit.svg',
    'create' => 'PluginCreate.svg',
    'show' => 'PluginShow.svg',
    'list' => 'PluginList.svg',
 ] as $identifier => $path) {
    $iconList['ext-addressmgmt-plugin-'.$identifier.'-icon'] = [
        'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        'source' => 'EXT:addressmgmt/Resources/Public/Icons/' . $path,
    ];
}

return $iconList;

