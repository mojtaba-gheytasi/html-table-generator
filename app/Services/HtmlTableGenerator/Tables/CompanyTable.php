<?php

namespace App\Services\HtmlTableGenerator\Tables;

use App\Services\HtmlTableGenerator\Column;
use App\Services\HtmlTableGenerator\HtmlTable;
use App\Services\HtmlTableGenerator\Repositories\FileRepository;
use App\Services\HtmlTableGenerator\Repositories\RepositoryInterface;

class InternetPackageTable extends HtmlTable
{
    protected function getRepository() : RepositoryInterface
    {
        return new FileRepository('users.json');
    }

    protected function columns(): array
    {
        return [
            Column::make('ID','id')
                ->sortable(),
            Column::make('FullName','name')
                ->searchable()
                ->sortable()
                ->setWidth(20)
                ->setDecorator(function (Object $entity) {
                    return $entity->name . ' / ' . $entity->name;
                }),
            Column::make('email-1','email')
                ->searchable()
                ->setDecorator(function (Object $entity) {
                    return $this->toHtml(
                        '<span class="badge light badge-success">'.$entity->email.'</span>'
                    );
                }),
            Column::make('email-2', 'email')
                ->setDecorator(function (Object $entity) {
                    return $this->toHtml(
                        '<span class="badge light badge-danger">'.$entity->email.'</span>'
                    );
                }),
            Column::make('Created At', 'created_at')
                ->sortable()
                ->setDecorator(function (Object $entity) {
                    return $this->changeDateTimeFormat($entity->created_at, 'H:i');
                }),
        ];
    }

    protected function heading(): string
    {
        return 'users-from-file';
    }
}
