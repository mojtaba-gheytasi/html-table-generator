<?php

declare(strict_types=1);

namespace App\Services\HtmlTableGenerator\Repositories;

use App\Services\ThirdPartyService\BugloosApiService;
use Illuminate\Support\Collection;

class BugloosApiRepository implements RepositoryInterface
{
    private string $listName;

    private array $params;

    private BugloosApiService $bugloosApiService;

    private Collection $collection;

    public function __construct(string $listName)
    {
        $this->listName = $listName;
        $this->bugloosApiService = new BugloosApiService;
    }

    public function applySearch(string $columnName, string $term)
    {
        $this->params['searchableColumn'][] = $columnName;
        $this->params['searchTerm'] ??= $term;
    }

    public function applySort($columnName, $direction)
    {
        $this->params['sortBy'] = $columnName;
        $this->params['sortDirection'] = $direction;
    }

    public function applyPagination(int $rowPerPage, int $pageNumber)
    {
        $this->params['rowPerPage'] = $rowPerPage;
        $this->params['page'] = $pageNumber;
    }

    public function getCount() : int
    {
        [$count, $this->collection] =
            $this->bugloosApiService->getTasks($this->listName, $this->params);

        return $count;
    }

    public function getRecords(): Collection
    {
        return $this->collection;
    }

    public function resourceIsInternal(): bool
    {
        return false;
    }
}
