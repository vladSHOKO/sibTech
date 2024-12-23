<?php

namespace App;

require_once "vendor/autoload.php";

use App\Model\CrmDataModel;
use App\Service\Bitrix24CrmDataService;
use App\Service\Collector\Bitrix24CrmDataCollector;
use App\Service\Filter\Bitrix24CrmDataFilter;
use App\Service\ShowCrmDataService;

function program(ShowCrmDataService $dataService, array $data): void
{
    $dataModel = new CrmDataModel($data);

    $dataService->showData($dataModel);
}


$showDataService = new ShowCrmDataService();
$dataCollector = new Bitrix24CrmDataCollector();
$dataFilter = new Bitrix24CrmDataFilter($dataCollector);
$dataService = new Bitrix24CrmDataService($dataFilter, $dataCollector);
$data = $dataService->mapData();

program($showDataService, $data);
