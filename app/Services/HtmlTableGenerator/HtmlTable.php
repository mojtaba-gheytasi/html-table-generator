<?php

namespace App\Services\HtmlTableGenerator;

use App\Services\HtmlTableGenerator\Repositories\RepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;

abstract class HtmlTable
{
    private ?string $sortBy;

    private string $sortDirection;

    private ?string $searchTerm;

    private int $rowPerPage;

    private int $pageNumber;

    public function __construct(Request $request)
    {
        $this->sortBy = $request->get('sortBy');
        $this->sortDirection = $request->get('sortDirection', 'asc');
        $this->searchTerm = $request->get('searchTerm');
        $this->rowPerPage = $request->get('rowPerPage', 20);
        $this->pageNumber = $request->get('pageNumber', 2);
    }

    abstract protected function getRepository() : RepositoryInterface;

    abstract protected function columns() : array;

    abstract protected function heading() : string;

    public function getResult() : array
    {
        [$count, $collection] = $this->getRowsFromRepository();

        $presenter = new Presenter($collection, $this->columns());

        $decoratedCollection = $presenter->present();

        return [
            'count' => $count,
            'collection' => $decoratedCollection,
            'columns' => $this->columns(),
            'sortBy' => $this->sortBy,
            'sortDirection' => $this->sortDirection,
            'searchTerm' => $this->searchTerm,
            'heading' => $this->heading(),
        ];
    }

    private function getRowsFromRepository() : array
    {
        $repository = $this->getRepository();

        if ($this->searchTerm !== null) {
            foreach ($this->columns() as $column) {

                if ($column->isSearchable()) {
                    $repository->applySearch($column->name, $this->searchTerm);
                }
            }
        }

        if ($this->sortBy !== null) {
            $repository->applySort($this->sortBy, $this->sortDirection);
        }

        $repository->applyPagination($this->rowPerPage, $this->getSkippableRowCount());

        return [
            $repository->getCount(),
            $repository->getRecords(),
        ];
    }

    private function getSkippableRowCount() : int
    {
        return $this->rowPerPage * ($this->pageNumber - 1);
    }

    protected function toHtml(string $html): HtmlString
    {
        return new HtmlString($html);
    }

    protected function toDateTimeFormat(string $dateTime, string $format) : string
    {
        return Carbon::make($dateTime)->format($format);
    }

}
