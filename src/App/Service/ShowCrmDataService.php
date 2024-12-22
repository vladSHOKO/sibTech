<?php

namespace App\Service;


use App\Model\CrmDataModel;

class ShowCrmDataService
{

    public function showData(CrmDataModel $dataModel): void
    {
        echo 'count_with_comments => ' . $dataModel->contactCountWithComments . '<br>';
        foreach ($dataModel->dealCountDifferentDirections as $key => $value) {
            echo 'count_' . $key . '_hopper' . ' => ' . $value . '<br>';
        }
        echo 'points_sum => ' . $dataModel->scoreSum . '<br>';
    }
}