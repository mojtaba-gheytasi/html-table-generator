<?php

namespace App\Services\HtmlTableGenerator\Repositories;

use Illuminate\Support\Collection;

class EloquentRepository implements RepositoryInterface
{
    public $queryBuilder;

    public function __construct($model)
    {
        $this->queryBuilder = $model::query();
    }

    public function applySearch(string $columnName, string $term)
    {
        $this->queryBuilder->orWhere($columnName, 'LIKE', '%' . $term . '%');
    }

    public function applySort($columnName, $direction)
    {
        $this->queryBuilder->orderBy($columnName, $direction);
    }

    public function applyPagination(int $rowPerPage, int $skippableRowCount)
    {
        $this->queryBuilder->offset($skippableRowCount)->limit($rowPerPage);
    }

    public function getCount() : int
    {
        return $this->queryBuilder->count();
    }

    public function getRecords() : Collection
    {
        return $this->queryBuilder->get();
    }
}
