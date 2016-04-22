<?php

namespace App\Http\Requests;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

abstract class PaginatedRequest extends Request
{
    use SortableRequest, SortableEntries;

    /**
     * Returns the entries for the current page for this view.
     *
     * @return LengthAwarePaginator containing the entries for the page, sorted/ordered or not.
     */
    public function getPaginatedEntries()
    {
        // Gets all the entries, sensitive to whether we're sorting for this request.
        $allEntries = $this->getEntriesSortable();

        $page = Paginator::resolveCurrentPage('page');

        // Returns the number of entries perpage, defined by Model#getPerPage
        $perPage = $allEntries->first()->getPerPage();

        // If the page number is beyond the number of pages, get it back to the last page.
        while (($page - 1) * $perPage > count($allEntries)) {
            $page -= 1;
        }

        // Return the subset of the entries for this page
        $entriesForPage = $allEntries->splice(($page - 1) * $perPage, $perPage);

        // Return the paginator for this subset.
        $entriesPaginator = new LengthAwarePaginator($entriesForPage, $this->getEntries()->first()->toBase()->getCountForPagination(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ]);

        // If we're ordering, append that to the links
        if ($this->getSortOrder()) {
            $entriesPaginator->appends(['order' => Request::get('order')]);
        }
        // If we're sorting, append that to the links
        if ($this->isSorting()) {
            $entriesPaginator->appends(['sort' => $this->getSortKey()]);
        }

        return $entriesPaginator;
    }

    /**
     * Renders the view with the collection bound to $varname and the
     * given variables, or, if there are no entries, falls back to the
     * behavior described by the subclass' whenEmpty() function
     *
     * @param $varname
     * @param array $variables
     * @return mixed
     */
    public function renderViewOrEmpty($varname, $variables = [])
    {
        if ($this->isEmpty()) {
            return $this->whenEmpty();
        } else {
            return $this->renderView($varname, $variables);
        }
    }

    /**
     * Renders the view with the collection bound to $varname with
     * no fallback behavior if empty.
     *
     * @param $varname
     * @param array $variables
     * @return mixed
     */
    public function renderView($varname, $variables = [])
    {
        $paginatedEntries = $this->getPaginatedEntries();

        return view($this->getViewName(), array_merge([$varname => $paginatedEntries], $variables));
    }

    /**
     * Gets all the entries that should be considered by the paginator.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public abstract function getEntries();

    /**
     * Get the name of the view for rendering.
     *
     * @return string
     */
    public abstract function getViewName();

    /**
     * Return the closure that returns the functionality
     * that should be carried out if empty.
     *
     * @return \Closure encapsulating behavior
     */
    public abstract function whenEmpty();

    /**
     * Returns whether or not any entries exist.
     *
     * @return bool
     */
    public abstract function isEmpty();

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
