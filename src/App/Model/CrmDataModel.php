<?php

namespace App\Model;

use http\Exception\InvalidArgumentException;

class CrmDataModel
{
    public int $contactCountWithComments;

    public int $dealCountWithoutContact;

    public array $dealCountDifferentDirections;

    public int $scoreSum;
    public function __construct(array $data)
    {
        if ($data['scoreSum'] < 0 || $data['contactCountWithComments'] < 0 || $data['dealCountWithoutContact'] < 0) {
            throw new InvalidArgumentException("Data cannot be zero less");
        }

        $this->contactCountWithComments = $data['contactCountWithComments'];
        $this->dealCountWithoutContact = $data['dealCountWithoutContact'];
        $this->dealCountDifferentDirections = $data['dealCountDifferentDirections'];
        $this->scoreSum = $data['scoreSum'];
    }


}