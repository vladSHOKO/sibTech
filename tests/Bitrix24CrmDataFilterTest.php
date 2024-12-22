<?php

use App\Service\Collector\Bitrix24CrmDataCollector;
use App\Service\Filter\Bitrix24CrmDataFilter;
use PHPUnit\Framework\TestCase;

class Bitrix24CrmDataFilterTest extends TestCase
{
    public function testContactsWithComment()
    {
        $dataCollector = new Bitrix24CrmDataCollector();
        $dataFilter = new Bitrix24CrmDataFilter($dataCollector);
        self::assertEquals('array', gettype($dataFilter->contactsWithComment()));

    }

}