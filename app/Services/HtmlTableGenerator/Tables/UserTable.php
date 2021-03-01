<?php

namespace App\Services\HtmlTableGenerator\Tables;

use App\Models\User;
use App\Services\HtmlTableGenerator\Column;
use App\Services\HtmlTableGenerator\HtmlTable;
use App\Services\HtmlTableGenerator\Repositories\EloquentRepository;
use App\Services\HtmlTableGenerator\Repositories\RepositoryInterface;
use Illuminate\Support\HtmlString;

class UserTable extends HtmlTable
{
    protected function getRepository() : RepositoryInterface
    {
        return new EloquentRepository(User::class);
    }

    public function columns() : array
    {
        return [
            Column::make('ID','id')
                ->sortable(),

            Column::make('name','name')
                ->searchable()
                ->sortable(),

            Column::make('Email','email')
                ->setWidth('20px')
                ->setDecorator(function (Object $entity) {
                    return $this->toEmail($entity->email);
                }),

            Column::make('Phone', 'phone')
                ->searchable(),

            Column::make('Balance', 'balance')
                ->sortable(),

            Column::make('Registration', 'created_at')
                ->sortable()
                ->setDecorator(function (Object $entity) {
                    return $this->changeDateTimeFormat($entity->created_at, 'Y-m-d H:i');
                }),
        ];
    }

    protected function heading() : string
    {
        return 'Users - from Eloquent(Database)';
    }
}
