<?php

namespace App\Service\Collector;

use App\Service\CrmDataCollectorInterface;

class Bitrix24CrmDataCollector
{
    private string $webHookURL;

    private int $entityID;

    public function __construct(string $webHookURL = 'https://b24-jr3k5i.bitrix24.ru/rest/1/m8plllckhgjsn4w0/', int $entityID = 1038)
    {
        $this->webHookURL = $webHookURL;
        $this->entityID = $entityID;
    }

    public function getContactList(): array
    {
        $start = 0;
        $limit = 50;

        $contactsList = [];

        do {
            $queryUrl = $this->webHookURL . 'crm.contact.list.json';
            $queryData = http_build_query([
                'start' => $start,
                'limit' => $limit,
            ]);

            $response = file_get_contents($queryUrl . '?' . $queryData);
            $result = json_decode($response, true);

            foreach ($result['result'] as $contact) {
                $contactsList[] = $contact;
            }
            $start += $limit;

        } while (count($result['result']) === $limit);

        return $contactsList;

    }

    public function getDealList(): array
    {
        $start = 0;
        $limit = 50;

        $dealsList = [];

        do {
            $queryUrl = $this->webHookURL . 'crm.deal.list.json';
            $queryData = http_build_query([
                'start' => $start,
                'limit' => $limit,
            ]);

            $response = file_get_contents($queryUrl . '?' . $queryData);
            $result = json_decode($response, true);

            foreach ($result['result'] as $deal) {
                $dealsList[] = $deal;
            }
            $start += $limit;

        } while (count($result['result']) === $limit);

        return $dealsList;
    }

    public function getCategoryList(): array
    {
        $start = 0;
        $limit = 50;

        $categoryList = [];

        do {
            $queryUrl = $this->webHookURL . 'crm.category.list.json';
            $queryData = http_build_query([
                'start' => $start,
                'limit' => $limit,
                'entityTypeId' => $this->entityID
            ]);

            $response = file_get_contents($queryUrl . '?' . $queryData);
            $result = json_decode($response, true);

            foreach ($result['result']['categories'] as $category) {
                $categoryList[] = $category;
            }
            $start += $limit;

        } while (count($result['result']['categories']) === $limit);

        return $categoryList;
    }

    public function getItemList(): array
    {
        $start = 0;
        $limit = 50;

        $itemsList = [];

        do {
            $queryUrl = $this->webHookURL . 'crm.item.list.json';
            $queryData = http_build_query([
                'start' => $start,
                'limit' => $limit,
                'entityTypeId' => $this->entityID
            ]);

            $response = file_get_contents($queryUrl . '?' . $queryData);
            $result = json_decode($response, true);

            foreach ($result['result']['items'] as $item) {
                $itemsList[] = $item;
            }
            $start += $limit;

        } while (count($result['result']['items']) === $limit);

        return $itemsList;
    }
}