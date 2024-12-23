<?php

namespace App\Service;

use App\Service\Collector\Bitrix24CrmDataCollector;
use App\Service\Filter\Bitrix24CrmDataFilter;

class Bitrix24CrmDataService
{
    private Bitrix24CrmDataFilter $bitrix24CrmDataFilter;

    private Bitrix24CrmDataCollector $bitrix24CrmDataCollector;

    public function __construct(Bitrix24CrmDataFilter $bitrix24CrmDataFilter, Bitrix24CrmDataCollector $bitrix24CrmDataCollector)
    {
        $this->bitrix24CrmDataFilter = $bitrix24CrmDataFilter;
        $this->bitrix24CrmDataCollector = $bitrix24CrmDataCollector;
    }

    private function itemsInCategories(): array
    {
        $items = $this->bitrix24CrmDataCollector->getItemList();
        $categoryList = $this->bitrix24CrmDataCollector->getCategoryList();

        $itemsCountInCategories = [];

        foreach ($categoryList as $category) {
            $itemsCountInCategories[$category['id']] = 0;
        }

        foreach ($items as $item) {
            foreach ($itemsCountInCategories as $key => $countInCategory) {
                if ($item['categoryId'] === $key) {
                    $itemsCountInCategories[$key]++;
                }
            }
        }

        return $itemsCountInCategories;
    }

    public function itemScoresSum(): int
    {
        $items = $this->bitrix24CrmDataCollector->getItemList();
        $score = 0;

        foreach ($items as $item) {
            $score += $item['ufCrm5_1734072847'];
        }
        return $score;
    }

    public function mapData(): array
    {
        return [
            'contactCountWithComments' => count($this->bitrix24CrmDataFilter->contactsWithComment($this->bitrix24CrmDataCollector->getContactList())),
            'dealCountWithoutContact' => count($this->bitrix24CrmDataFilter->dealsWithoutContact($this->bitrix24CrmDataCollector->getDealList())),
            'dealCountDifferentDirections' => $this->itemsInCategories(),
            'scoreSum' => $this->itemScoresSum(),
        ];

    }
}
