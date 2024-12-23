<?php

namespace App\Service\Filter;

class Bitrix24CrmDataFilter
{
    public function contactsWithComment(array $contacts): array
    {
        return array_filter($contacts, function ($contact) {
            return $contact['COMMENTS'];
        });
    }

    public function dealsWithoutContact(array $deals): array
    {
        return array_filter($deals, function ($deal) {
            return $deal['CONTACT_ID'] === null;
        });
    }
}
