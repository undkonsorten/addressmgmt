<?php

declare(strict_types=1);

namespace Undkonsorten\Addressmgmt\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\AbstractListTypeToCTypeUpdate;

#[UpgradeWizard('undkonsortenAddressmgmtCTypeMigration')]
final class UndkonsortenAddressmgmtCTypeMigration extends AbstractListTypeToCTypeUpdate
{
    public function getTitle(): string
    {
        return 'Migrate "Undkonsorten Addressmgmt" plugins to content elements.';
    }

    public function getDescription(): string
    {
        return 'The "Undkonsorten Addressmgmt" plugins are now registered as content element. Update migrates existing records and backend user permissions.';
    }

    /**
     * This must return an array containing the "list_type" to "CType" mapping
     *
     *  Example:
     *
     *  [
     *      'pi_plugin1' => 'pi_plugin1',
     *      'pi_plugin2' => 'new_content_element',
     *  ]
     *
     * @return array<string, string>
     */
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'addressmgmt_list' => 'addressmgmt_list',
            'addressmgmt_show' => 'addressmgmt_show',
            'addressmgmt_create' => 'addressmgmt_create',
            'addressmgmt_edit' => 'addressmgmt_edit',
            'addressmgmt_dash' => 'addressmgmt_dash',
        ];
    }
}
