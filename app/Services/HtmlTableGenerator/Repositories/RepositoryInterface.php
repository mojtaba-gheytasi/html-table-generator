<?php

namespace App\Services\HtmlTableGenerator\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function applySearch(string $columnName, string $term);

    public function applySort(string $columnName, string $direction);

    public function applyPagination(int $rowPerPage, int $pageNumber);

    public function getCount() : int;

    public function getRecords() : Collection;

    /**
    * when data comes from disk or memory of local server, is internal
    * when data comes from third party api, is external or not internal
    **/
    public function resourceIsInternal() : bool;
}
