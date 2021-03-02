<?php

declare(strict_types=1);

namespace App\Services\HtmlTableGenerator\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileRepository implements RepositoryInterface
{
    private Collection $collection;

    private Collection $filteredCollection;

    public function __construct(string $fileName)
    {
        $this->collection = collect(json_decode(Storage::get('json-data/'.$fileName)));
        $this->filteredCollection = collect();
    }

    public function applySearch(string $columnName, string $term)
    {
        $filteredRows = $this->collection->filter(function ($row) use ($term, $columnName) {
            return strpos(Str::lower($row->{$columnName}), $term) !== false;
        });

        $this->filteredCollection->push(...$filteredRows);
    }

    public function applySort($columnName, $direction)
    {
        $this->updateCollectionData();

        $sortedCollection = $direction === 'asc' ?
            $this->collection->sortBy($columnName) :
            $this->collection->sortByDesc($columnName);

        $this->collection = $sortedCollection->values();
    }

    public function applyPagination(int $rowPerPage, int $pageNumber)
    {
        $skippableRowCount = $this->getSkippableRowCount($rowPerPage, $pageNumber);

        $this->collection = $this->collection->skip($skippableRowCount)->take($rowPerPage);
    }

    public function getCount() : int
    {
        return $this->collection->count();
    }

    public function getRecords() : Collection
    {
        return $this->collection;
    }

    public function resourceIsInternal(): bool
    {
        return true;
    }

    private function getSkippableRowCount(int $rowPerPage, int $pageNumber) : int
    {
        return $rowPerPage * ($pageNumber - 1);
    }

    private function updateCollectionData()
    {
        if ($this->filteredCollection->count() > 0) {
            $this->collection = $this->filteredCollection->unique();
        }
    }
}
