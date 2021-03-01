<?php

namespace App\Services\HtmlTableGenerator\Paginator;

use Illuminate\Support\Collection;

interface PaginatorInterface
{
    public function paginate(Collection $collection,
        int $totalCount,
        int $rowPerPage,
        int $pageNumber,
        string $path
    );
}
