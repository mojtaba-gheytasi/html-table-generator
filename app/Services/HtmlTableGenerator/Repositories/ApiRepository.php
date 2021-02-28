<?php

namespace App\Services\HtmlTableGenerator\Repositories;

use Illuminate\Support\Collection;

class ApiRepository implements RepositoryInterface
{

    public $queryBuilder;

    public function __construct($model)
    {
        $this->queryBuilder = $model::query();
    }

    public function applySearch(string $columnName, string $term)
    {
        // TODO: Implement getRecords() method.
    }

    public function applySort($columnName, $direction)
    {
        // TODO: Implement getRecords() method.
    }

    public function applyPagination(int $rowPerPage, int $skippableRowCount)
    {
        // TODO: Implement getRecords() method.
    }

    public function getCount() : int
    {
        // TODO: Implement getRecords() method.
    }


    public function getRecords(): Collection
    {
        // TODO: Implement getRecords() method.
    }
}
