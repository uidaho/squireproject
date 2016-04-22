<?php

namespace App\Http\Requests;

trait SortableRequest
{
    public function isSorting()
    {
        return $this->get('sort');
    }

    public function isSortDescending()
    {
        return $this->getSortOrder() == SortOrder::Descending;
    }

    public function getSortOrder()
    {
        switch ($this->get('order'))
        {
            case 'desc':
                return SortOrder::Descending;
                break;
            default:
                return SortOrder::Ascending;
        }
    }

    public function getSortOrderFriendly()
    {
        return SortOrder::getFriendlyForOrder($this->getSortOrder());
    }
}

trait SortableEntries
{
    public function getEntriesSortable()
    {
        if ($this->isSorting()) {
            return $this->getAllEntriesSorted();
        } else {
            return $this->getEntries();
        }
    }

    public function getAllEntriesSorted()
    {
        return $this->getEntries()->sort($this->getSortingFunction());
    }

    public function getSortingFunction()
    {
        $key = $this->getSortKey();
        $reverse = $this->isSortDescending();

        return function($a, $b) use($key, $reverse) {
            $result = strtolower($a[$key]) > strtolower($b[$key]);
            return $reverse ? !$result : $result;
        };
    }

    public function getSortKey()
    {
        return $this->get('sort');
    }

    public function getSortKeyFriendly()
    {
        return ucwords(preg_replace('[_]', ' ', $this->getSortKey()));
    }

}

abstract class SortOrder
{
    const Ascending = 'asc';
    const Ascending_Friendly = 'Ascending';
    const Descending = 'desc';
    const Descending_Friendly = 'Descending';

    public static function getFriendlyForOrder($order)
    {
        if ($order == SortOrder::Ascending) {
            return SortOrder::Ascending_Friendly;
        }

        return SortOrder::Descending_Friendly;
    }
}