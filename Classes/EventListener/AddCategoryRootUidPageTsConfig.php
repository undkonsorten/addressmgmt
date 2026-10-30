<?php

declare(strict_types=1);

namespace Undkonsorten\Addressmgmt\EventListener;

use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\TypoScript\IncludeTree\Event\ModifyLoadedPageTsConfigEvent;
use Undkonsorten\Addressmgmt\Service\ExtensionConfigurationService;

#[AsEventListener(identifier: 'addressmgmt/category-root-uid')]
final class AddCategoryRootUidPageTsConfig
{
    public function __invoke(ModifyLoadedPageTsConfigEvent $event): void
    {
        $rootCategory = ExtensionConfigurationService::getInstance('addressmgmt')->getProperty('rootCategory');
        $event->addTsConfig(sprintf(
            'TCEFORM.tt_content.pi_flexform.addressmgmt_list.sDEF.settings\.category.config.treeConfig.rootUid = %d' . PHP_EOL,
            $rootCategory
        ));
    }
}
