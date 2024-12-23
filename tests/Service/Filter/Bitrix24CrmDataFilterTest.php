<?php

namespace App\Tests\Service\Filter;

use App\Service\Filter\Bitrix24CrmDataFilter;
use PHPUnit\Framework\TestCase;

class Bitrix24CrmDataFilterTest extends TestCase
{
    public function testContactsWithComment()
    {
        $bitrix24CrmDataFilter = new Bitrix24CrmDataFilter();

        $contacts = [
            [
                'NAME' => 'Name1',
                'COMMENTS' => 'Some comments',
            ],
            [
                'NAME' => 'Name2',
                'COMMENTS' => null,
            ]
        ];
        self::assertCount(1, $bitrix24CrmDataFilter->contactsWithComment($contacts));
        self::assertEquals('Name1', $bitrix24CrmDataFilter->contactsWithComment($contacts)[0]['NAME']);
    }

    public function testDealsWithoutContact()
    {
        $bitrix24CrmDataFilter = new Bitrix24CrmDataFilter();

        $deals = [
            [
                'TITLE' => 'Deal1',
                'CONTACT_ID' => 1,
            ],
            [
                'TITLE' => 'Deal2',
                'CONTACT_ID' => 2,
            ],
            [
                'TITLE' => 'Deal3',
                'CONTACT_ID' => null,
            ],
        ];

        self::assertCount(1, $bitrix24CrmDataFilter->dealsWithoutContact($deals));
        self::assertEquals('Deal3', $bitrix24CrmDataFilter->dealsWithoutContact($deals)[2]['TITLE']);
    }
}
