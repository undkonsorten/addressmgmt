<?php
declare(strict_types = 1);

return [
    Undkonsorten\Addressmgmt\Domain\Model\Address::class => [
        'tableName' => 'tx_addressmgmt_domain_model_address',
        'subclasses' => [
            'Undkonsorten\Addressmgmt\Domain\Model\Address\Person' => \Undkonsorten\Addressmgmt\Domain\Model\Address\Person::class,
            'Undkonsorten\Addressmgmt\Domain\Model\Address\Organisation' => \Undkonsorten\Addressmgmt\Domain\Model\Address\Organisation::class,
            'Undkonsorten\Addressmgmt\Domain\Model\Address\Location' => \Undkonsorten\Addressmgmt\Domain\Model\Address\Location::class
        ]
    ],
    \Undkonsorten\Addressmgmt\Domain\Model\Address\Organisation::class => [
        'tableName' => 'tx_addressmgmt_domain_model_address',
        'recordType' => 'Tx_Addressbook_Organisation'
    ],
    \Undkonsorten\Addressmgmt\Domain\Model\Address\Person::class => [
        'tableName' => 'tx_addressmgmt_domain_model_address',
        'recordType' => 'Tx_Addressbook_Person'
    ],
    Undkonsorten\Addressmgmt\Domain\Model\Address\Location::class => [
        'tableName' => 'tx_addressmgmt_domain_model_address',
        'recordType' => 'Tx_Addressbook_Location'

    ]
];
