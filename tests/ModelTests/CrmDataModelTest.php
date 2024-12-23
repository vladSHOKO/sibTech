<?php

namespace App\Tests\ModelTests;

use App\Model\CrmDataModel;
use PHPUnit\Framework\TestCase;

class CrmDataModelTest extends TestCase
{

    public function testCRMDataModel()
    {
        $dataModel = new CrmDataModel([
            'contactCountWithComments' => 1,
            'dealCountWithoutContact' => 2,
            'dealCountDifferentDirections' => ['Direction1' => 3, 'Direction2' => 2],
            'scoreSum' => 4
        ]);

        self::assertEquals(1, $dataModel->contactCountWithComments);
        self::assertEquals(2, $dataModel->dealCountWithoutContact);
        self::assertEquals(['Direction1' => 3, 'Direction2' => 2], $dataModel->dealCountDifferentDirections);
        self::assertEquals(4, $dataModel->scoreSum);

    }

}