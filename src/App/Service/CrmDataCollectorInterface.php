<?php

namespace App\Service;

interface CrmDataCollectorInterface
{
    function getContactList(): array;

    function getDealList(): array;

    function getCategoryList(): array;

    function getItemList(): array;

}