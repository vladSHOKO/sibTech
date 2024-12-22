<?php

namespace App\Service\Filter;

use App\Service\Collector\Bitrix24CrmDataCollector;
use App\Service\CrmDataFilterInterface;

class Bitrix24CrmDataFilter implements CrmDataFilterInterface
{
    private Bitrix24CrmDataCollector $bitrix24CrmDataCollector;

    public function __construct(Bitrix24CrmDataCollector $bitrix24CrmDataCollector)
    {
        $this->bitrix24CrmDataCollector = $bitrix24CrmDataCollector;
    }

    public function contactsWithComment(): array
    {
        $contacts = $this->bitrix24CrmDataCollector->getContactList();

        return array_filter($contacts, function ($contact) {
            return $contact['COMMENTS'];
        });
    }

    public function dealsWithoutContact(): array
    {
        $deals = $this->bitrix24CrmDataCollector->getDealList();

        return array_filter($deals, function ($deal) {
            return $deal['CONTACT_ID'] === null;
        });
    }

    public function itemsInCategories(): array
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

    public function scores(): array
    {
        $items = $this->bitrix24CrmDataCollector->getItemList();
        $score = [];

        foreach ($items as $item) {
            $score[] = $item['ufCrm5_1734072847'];
        }
        return $score;
    }


    public function mapData(): array
    {
        return [
            'contactCountWithComments' => count($this->contactsWithComment()),
            'dealCountWithoutContact' => count($this->dealsWithoutContact()),
            'dealCountDifferentDirections' => $this->itemsInCategories(),
            'scoreSum' => array_sum($this->scores())
        ];

    }
}