<?php
declare(strict_types = 1);

use Undkonsorten\Addressmgmt\Domain\Model\Address;
use Undkonsorten\Addressmgmt\Domain\Model\Address\Person;
use Undkonsorten\Addressmgmt\Domain\Model\Address\Organisation;
use Undkonsorten\Addressmgmt\Domain\Model\Address\Location;

return [
    Address::class => [
        'tableName' => 'tx_addressmgmt_domain_model_address',
        'subclasses' => [
            'Undkonsorten\Addressmgmt\Domain\Model\Address\Person' => Person::class,
            'Undkonsorten\Addressmgmt\Domain\Model\Address\Organisation' => Organisation::class,
            'Undkonsorten\Addressmgmt\Domain\Model\Address\Location' => Location::class
        ]
    ],
    Organisation::class => [
        'tableName' => 'tx_addressmgmt_domain_model_address',
        'recordType' => 'Tx_Addressbook_Organisation'
    ],
    Person::class => [
        'tableName' => 'tx_addressmgmt_domain_model_address',
        'recordType' => 'Tx_Addressbook_Person'
    ],
    Location::class => [
        'tableName' => 'tx_addressmgmt_domain_model_address',
        'recordType' => 'Tx_Addressbook_Location'

    ]
];
