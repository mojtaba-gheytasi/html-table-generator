<?php

declare(strict_types=1);

namespace App\Services\HtmlTableGenerator;

use App\Services\HtmlTableGenerator\Decorator\Decorator;
use App\Services\HtmlTableGenerator\Decorator\DecoratorHelper;
use App\Services\HtmlTableGenerator\Paginator\PaginatorInterface;
use App\Services\HtmlTableGenerator\Repositories\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class HtmlTable
{
    use DecoratorHelper;

    private ?string $sortBy;

    private string $sortDirection;

    private ?string $searchTerm;

    private int $rowPerPage;

    private int $pageNumber;

    private string $urlPath;

    private PaginatorInterface $paginator;

    public function __construct(Request $request)
    {
        $this->urlPath = $request->path();
        $this->sortBy = $request->get('sortBy');
        $this->sortDirection = $request->get('sortDirection', 'asc');
        $this->searchTerm = $request->get('searchTerm') ? Str::lower($request->get('searchTerm')) : null;
        $this->rowPerPage = (int) $request->get('rowPerPage', 10);
        $this->pageNumber = (int) $request->get('page', 1);
        $this->paginator = resolve(PaginatorInterface::class);
    }

    abstract protected function getRepository() : RepositoryInterface;

    abstract protected function columns() : array;

    abstract protected function heading() : string;

    public function getResult() : array
    {
        [$count, $collection] = $this->getResultFromRepository();

        $decoratedCollection = (new Decorator($collection, $this->columns()))->decorate();

        $paginatedResult = $this->paginator->paginate(
            $decoratedCollection,
            $count,
            $this->rowPerPage,
            $this->pageNumber,
            $this->urlPath
        );

        return [
            'paginator' => $paginatedResult,
            'columns' => $this->columns(),
            'sortableColumns' => $this->getSortableColumns(),
            'heading' => $this->heading(),
        ];
    }

    public function getSortableColumns() : array
    {
        return array_filter($this->columns(), function ($column) {
            return $column->isSortable();
        });
    }

    private function getResultFromRepository() : array
    {
        $repository = $this->getRepository();

        if ($this->searchTerm !== null) {
            foreach ($this->columns() as $column) {
                if ($column->isSearchable()) {
                    $repository->applySearch($column->getName(), $this->searchTerm);
                }
            }
        }

        if ($this->sortBy !== null) {
            $repository->applySort($this->sortBy, $this->sortDirection);
        }

        $count = null;

        if ($repository->resourceIsInternal()) {
            $count = $repository->getCount();
        }

        $repository->applyPagination($this->rowPerPage, $this->pageNumber);

        if ($count === null) {
            $count = $repository->getCount();
        }

        return [
            $count,
            $repository->getRecords(),
        ];
    }

}
