<?php

namespace App\Tests;

use App\Service\Collector\Bitrix24CrmDataCollector;
use PHPUnit\Framework\TestCase;

class Bitrix24CrmDataCollectorTest extends TestCase
{
    public function testGetContactList()
    {
        $dataCollector = new Bitrix24CrmDataCollector();
        self::assertEquals('array', gettype($dataCollector->getContactList()));
    }

    public function testGetDealList()
    {
        $dataCollector = new Bitrix24CrmDataCollector();
        self::assertEquals('array', gettype($dataCollector->getDealList()));
    }

    public function testGetItemList()
    {
        $dataCollector = new Bitrix24CrmDataCollector();
        self::assertEquals('array', gettype($dataCollector->getItemList()));
    }

    public function testGetCategoryList()
    {
        $dataCollector = new Bitrix24CrmDataCollector();
        self::assertEquals('array', gettype($dataCollector->getCategoryList()));
    }

}