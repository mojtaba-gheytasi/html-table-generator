<?php

namespace App\Services\HtmlTableGenerator\Tables;

use App\Models\User;
use App\Services\HtmlTableGenerator\Column;
use App\Services\HtmlTableGenerator\HtmlTable;
use App\Services\HtmlTableGenerator\Repositories\EloquentRepository;
use App\Services\HtmlTableGenerator\Repositories\RepositoryInterface;

class UserTable extends HtmlTable
{
    protected function getRepository() : RepositoryInterface
    {
        return new EloquentRepository(User::class);
    }

    protected function columns() : array
    {
        return [
            Column::make('ID','id')
                ->searchable()
                ->sortable()
                ->setWidth(20),
            Column::make('FullName')
                ->searchable()
                ->sortable()
                ->setDecorator(function (Object $entity) {
                    return $entity->name . ' / ' . $entity->name;
                }),
            Column::make('email1')
                ->setDecorator(function (Object $entity) {
                    return $this->toHtml(
                        '<span class="badge light badge-success">'.$entity->email.'</span>'
                    );
                }),
            Column::make('email2')
                ->setDecorator(function (Object $entity) {
                    return $this->toHtml(
                        '<span class="badge light badge-danger">'.$entity->email.'</span>'
                    );
                }),
            Column::make('Created At')
                ->sortable()
                ->setDecorator(function (Object $entity) {
//                    return $this->toDateTimeFormat('19:27:08', 'H:i');
                    return $this->toDateTimeFormat($entity->created_at, 'Y-m');
                }),
        ];
    }

    protected function heading() : string
    {
        return 'Users Table';
    }
}
