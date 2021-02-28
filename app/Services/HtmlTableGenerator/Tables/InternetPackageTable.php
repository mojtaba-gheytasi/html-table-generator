<?php

namespace App\Services\HtmlTableGenerator\Tables;

use App\Models\User;
use App\Services\HtmlTableGenerator\Column;
use App\Services\HtmlTableGenerator\HtmlTable;
use App\Services\HtmlTableGenerator\Repositories\ApiRepository;
use App\Services\HtmlTableGenerator\Repositories\EloquentRepository;
use App\Services\HtmlTableGenerator\Repositories\RepositoryInterface;

class InternetPackageTable extends HtmlTable
{
    protected function getRepository() : RepositoryInterface
    {
        return new ApiRepository();
    }

    protected function columns(): array
    {
        return [
            Column::make('num')
                ->searchable()
                ->sortable()
                ->setWidth(10),
            Column::make('name')
                ->searchable(),
        ];
    }

    protected function heading(): string
    {
        // TODO: Implement heading() method.
    }
}
