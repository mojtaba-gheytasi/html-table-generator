<?php

declare(strict_types=1);

namespace App\Services\HtmlTableGenerator\Paginator;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;

class LaravelPaginator implements PaginatorInterface
{
    public function paginate(
        Collection $collection,
        int $totalCount,
        int $rowPerPage,
        int $pageNumber,
        string $path
    ) : Paginator {

        return new LengthAwarePaginator(
            $collection,
            $totalCount,
            $rowPerPage,
            $pageNumber,
            ['path' => $path]
        );
    }
}
