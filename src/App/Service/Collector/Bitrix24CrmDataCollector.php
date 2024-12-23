<?php

namespace App\Service\Collector;

class Bitrix24CrmDataCollector
{
    private string $webHookURL;

    private int $entityID;

    public function __construct(string $webHookURL = 'https://b24-jr3k5i.bitrix24.ru/rest/1/m8plllckhgjsn4w0/', int $entityID = 1038)
    {
        $this->webHookURL = $webHookURL;
        $this->entityID = $entityID;
    }

    private function getData(string $dataType): array
    {
        $start = 0;
        $limit = 50;

        $dataList = [];

        do {
            $queryUrl = $this->webHookURL . 'crm.' . $dataType . '.list.json';
            $queryData = http_build_query([
                'start' => $start,
                'limit' => $limit,
                'entityTypeId' => $this->entityID,
            ]);

            $response = file_get_contents($queryUrl . '?' . $queryData);
            $results = json_decode($response, true);

            if ($dataType === 'item') {
                $resultType = $results['result']['items'];
            } elseif ($dataType === 'category') {
                $resultType = $results['result']['categories'];
            } else {
                $resultType = $results['result'];
            }

            foreach ($resultType as $result) {
                $dataList[] = $result;
            }

            $start += $limit;

        } while (count($resultType) === $limit);

        return $dataList;

    }

    public function getContactList(): array
    {
        return $this->getData('contact');
    }

    public function getDealList(): array
    {
        return $this->getData('deal');
    }

    public function getCategoryList(): array
    {
        return $this->getData('category');
    }

    public function getItemList(): array
    {
        return $this->getData('item');
    }
}
