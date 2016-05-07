<?php

namespace App\Http\Requests;

/**
 * Trait SortableRequest
 *
 * Defines behavior for sorting.
 *
 * @author Rick Boss
 * @package App\Http\Requests
 */
trait SortableRequest
{
    /**
     * Returns whether the request has the sorting key or not.
     *
     * @return mixed
     */
    public function isSorting()
    {
        return $this->has('sort');
    }

    /**
     * Returns whether the the request has the sort order set to
     * descending.
     *
     * @return bool
     */
    public function isSortDescending()
    {
        return $this->isSorting() ? $this->getSortOrder() == SortOrder::Descending : false;
    }

    /**
     * Returns the sort order for the given request.
     * Denoted in the url by .../?order={desc|asc}
     *
     * @return string
     */
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

    /**
     * Gets the human friendly name of the active sort order.
     *
     * @return string
     */
    public function getSortOrderFriendly()
    {
        return SortOrder::getFriendlyForOrder($this->getSortOrder());
    }
}

/**
 * Trait SortableEntries
 *
 * Allows for sorting of Eloquent models.
 *
 * @package App\Http\Requests
 */
trait SortableEntries
{
    /**
     * Helper function to return the entries, if the request has the sorted key
     * it will sort the collection first.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[] collection of models
     */
    public function getEntriesSortable()
    {
        if ($this->isSorting()) {
            return $this->getAllEntriesSorted();
        } else {
            return $this->getEntries();
        }
    }

    /**
     * Returns the entries sorted by the sorting function.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[] collection of models
     */
    public function getAllEntriesSorted()
    {
        return $this->getEntries()->sort($this->getSortingFunction());
    }

    /**
     * Returns the sorting function for the request. Default is string
     * comparison with all characters in lower case.
     *
     * @return \Closure
     */
    public function getSortingFunction()
    {
        $key = $this->getSortKey();
        $reverse = $this->isSortDescending();

        return function($a, $b) use($key, $reverse) {
            $result = strtolower($a[$key]) > strtolower($b[$key]);
            return $reverse ? !$result : $result;
        };
    }

    /**
     * Returns the sort key attached to the Request
     *
     * @return string
     */
    public function getSortKey()
    {
        return $this->get('sort');
    }

    /**
     * Returns the friendly name of the sort key, converting
     * from lower underscore to upper normal case.
     *
     * E.g. modified_at => Modified At
     *
     * @return string
     */
    public function getSortKeyFriendly()
    {
        return ucwords(preg_replace('[_]', ' ', $this->getSortKey()));
    }

}

/**
 * Class SortOrder
 *
 * Plays the role of an Enum
 *
 * @package App\Http\Requests
 */
abstract class SortOrder
{
    const Ascending = 'asc';
    const Ascending_Friendly = 'Ascending';
    const Descending = 'desc';
    const Descending_Friendly = 'Descending';

    /**
     * Convert the given order to it's human readable name.
     *
     * @param $order
     * @return string
     */
    public static function getFriendlyForOrder($order)
    {
        if ($order == SortOrder::Ascending) {
            return SortOrder::Ascending_Friendly;
        }

        return SortOrder::Descending_Friendly;
    }
}
