<?php

namespace App\Services\HtmlTableGenerator\Tables;

use App\Services\HtmlTableGenerator\Column;
use App\Services\HtmlTableGenerator\HtmlTable;
use App\Services\HtmlTableGenerator\Repositories\FileRepository;
use App\Services\HtmlTableGenerator\Repositories\RepositoryInterface;

class EmployeeTable extends HtmlTable
{
    protected function getRepository(): RepositoryInterface
    {
        return new FileRepository('employees.json');
    }

    protected function columns(): array
    {
        return [
            Column::make('Employee ID','id')
                ->sortable(),

            Column::make('Name','name')
                ->sortable()
                ->searchable()
                ->setDecorator(function (Object $entity) {
                    return $this->toHtml('<b>' . $entity->name . '</b>');
                }),

            Column::make('Phone','phone')
                ->setWidth('15%'),

            Column::make('Office code','office_code')
                ->sortable(),

            Column::make('Job title', 'job_title')
                ->searchable()
                ->sortable(),
        ];
    }

    protected function heading(): string
    {
        return 'Employees - from File';
    }

}
