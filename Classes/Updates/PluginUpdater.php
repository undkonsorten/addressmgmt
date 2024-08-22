<?php

declare(strict_types=1);

/*
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Undkonsorten\Addressmgmt\Updates;

use TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

class PluginUpdater implements UpgradeWizardInterface
{
    private const MIGRATION_SETTINGS = [
        [
            'switchableControllerActions' => 'Address->list;Address->show',
            'targetListType' => 'addressmgmt_list',
        ],
        [
            'switchableControllerActions' => 'Address->show',
            'targetListType' => 'addressmgmt_show',
        ],
        [
            'switchableControllerActions' => 'Address->new;Address->create;Address->dash',
            'targetListType' => 'addressmgmt_create',
        ],
        [
            'switchableControllerActions' => 'Address->edit;Address->update;Address->dash',
            'targetListType' => 'addressmgmt_edit',
        ],
        [
            'switchableControllerActions' => 'Address->dash;File->edit;File->update;File->new;File->create;File->delete;Address->edit;Address->update;Address->new;Address->create;Address->handInForReview;Address->delete;Address->remove;SocialIdentifier->create;SocialIdentifier->delete;SocialIdentifier->update;SocialIdentifier->edit;',
            'targetListType' => 'addressmgmt_dash',
        ]
    ];

    /** @var FlexFormService */
    protected $flexFormService;

    /**
     * @var FlexFormTools
     */
    protected $flexFormTools;


    public function __construct()
    {
        $this->flexFormService = GeneralUtility::makeInstance(FlexFormService::class);
        $this->flexFormTools = GeneralUtility::makeInstance(FlexFormTools::class);
    }

    public function getIdentifier(): string
    {
        return 'txAddressmgmtPluginUpdater';
    }

    public function getTitle(): string
    {
        return 'EXT:addressmgmt: Migrate plugins';
    }

    public function getDescription(): string
    {
        $description = 'The old plugin using switchableControllerActions has been split into separate plugins. ';
        $description .= 'This update wizard migrates all existing plugin settings and changes the plugin';
        $description .= 'to use the new plugins available. Count of plugins: ' . count($this->getMigrationRecords());
        return $description;
    }

    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class,
        ];
    }

    public function updateNecessary(): bool
    {
        return $this->checkIfWizardIsRequired();
    }

    public function executeUpdate(): bool
    {
        return $this->performMigration();
    }

    public function checkIfWizardIsRequired(): bool
    {
        return count($this->getMigrationRecords()) > 0;
    }

    public function performMigration(): bool
    {
        $records = $this->getMigrationRecords();

        // Initialize the global $LANG object if it does not exist.
        // This is needed by the ext:form flexforms hook in Core v11
        $GLOBALS['LANG'] = $GLOBALS['LANG'] ?? GeneralUtility::makeInstance(LanguageServiceFactory::class)->create('default');

        foreach ($records as $record) {
            $flexForm = $this->flexFormService->convertFlexFormContentToArray($record['pi_flexform']);
            $targetListType = $this->getTargetListType($flexForm['switchableControllerActions'] ?? '');

            if ($targetListType === '') {
                continue;
            }

            // Update record with migrated types (this is needed because FlexFormTools
            // looks up those values in the given record and assumes they're up-to-date)
            $record['CType'] = $targetListType;
            $record['list_type'] = '';

            // Clean up flexform
            $newFlexform = $this->flexFormTools->cleanFlexFormXML('tt_content', 'pi_flexform', $record);
            $flexFormData = GeneralUtility::xml2array($newFlexform);

            // Remove flexform data which do not exist in flexform of new plugin
            if(is_array($flexFormData) && is_array($flexFormData['data'])){
                foreach ($flexFormData['data'] as $sheetKey => $sheetData) {
                    // Remove empty sheets
                    if (!count($flexFormData['data'][$sheetKey]['lDEF']) > 0) {
                        unset($flexFormData['data'][$sheetKey]);
                    }
                }
                if (count($flexFormData['data']) > 0) {
                    $newFlexform = $this->array2xml($flexFormData);
                }
            }else{
                $newFlexform = '';
            }

            $this->updateContentElement($record['uid'], $targetListType, $newFlexform);
        }

        return true;
    }

    protected function getMigrationRecords(): array
    {
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $queryBuilder = $connectionPool->getQueryBuilderForTable('tt_content');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        return $queryBuilder
            ->select('uid', 'pid', 'CType', 'list_type', 'pi_flexform')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq(
                    'CType',
                    $queryBuilder->createNamedParameter('list')
                ),
                $queryBuilder->expr()->eq(
                    'list_type',
                    $queryBuilder->createNamedParameter('addressmgmt_list')
                )
            )
            ->executeQuery()
            ->fetchAllAssociative();
    }

    protected function getTargetListType(string $switchableControllerActions): string
    {
        foreach (self::MIGRATION_SETTINGS as $setting) {
            if ($setting['switchableControllerActions'] === $switchableControllerActions
            ) {
                return $setting['targetListType'];
            }
        }

        return '';
    }

    /**
     * Updates list_type and pi_flexform of the given content element UID
     *
     * @param int $uid
     * @param string $newCtype
     * @param string $flexform
     */
    protected function updateContentElement(int $uid, string $newCtype, string $flexform): void
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $queryBuilder->update('tt_content')
            ->set('CType', $newCtype)
            ->set('list_type', '')
            ->set('pi_flexform', $flexform)
            ->where(
                $queryBuilder->expr()->in(
                    'uid',
                    $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)
                )
            )
            ->executeStatement();
    }

    /**
     * Transforms the given array to FlexForm XML
     *
     * @param array $input
     * @return string
     */
    protected function array2xml(array $input = []): string
    {
        $options = [
            'parentTagMap' => [
                'data' => 'sheet',
                'sheet' => 'language',
                'language' => 'field',
                'el' => 'field',
                'field' => 'value',
                'field:el' => 'el',
                'el:_IS_NUM' => 'section',
                'section' => 'itemType',
            ],
            'disableTypeAttrib' => 2,
        ];
        $spaceInd = 4;
        $output = GeneralUtility::array2xml($input, '', 0, 'T3FlexForms', $spaceInd, $options);
        $output = '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>' . LF . $output;
        return $output;
    }
}
