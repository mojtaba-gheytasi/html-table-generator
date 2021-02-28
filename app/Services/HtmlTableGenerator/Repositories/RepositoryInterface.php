<?php

namespace App\Services\HtmlTableGenerator\Repositories;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function applySearch(string $columnName, string $term);

    public function applySort(string $columnName, string $direction);

    public function applyPagination(int $rowPerPage, int $skippableRowCount);

    public function getCount() : int;

    public function getRecords() : Collection;
}
