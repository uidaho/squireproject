<?php

namespace App\Http\Requests;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

abstract class PaginatedRequest extends Request
{
    use SortableRequest, SortableEntries;

    private $empty = false;

    public function getPaginatedEntries()
    {
        $allEntries = $this->getEntriesSortable();

        if (count($allEntries) == 0) {
            $this->empty = true;
            return $this->whenEmpty();
        }

        $page = Paginator::resolveCurrentPage('page');
        $perPage = $allEntries->first()->getPerPage();  // TODO: Will crash if no entries, what should be the fallback...

        while (($page - 1) * $perPage > count($allEntries)) {
            $page -= 1;
        }

        $projects = new LengthAwarePaginator($allEntries->splice(($page - 1) * $perPage, $perPage), $this->getEntries()->first()->toBase()->getCountForPagination(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ]);

        if ($this->getSortOrder()) {
            $projects->appends(['order' => Request::get('order')]);
        }
        if ($this->isSorting()) {
            $projects->appends(['sort' => $this->getSortKey()]);
        }

        return $projects;
    }

    public abstract function getEntries();
    
    public abstract function whenEmpty();

    public function isEmpty()
    {
        return $this->empty;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public abstract function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public abstract function rules();
}
