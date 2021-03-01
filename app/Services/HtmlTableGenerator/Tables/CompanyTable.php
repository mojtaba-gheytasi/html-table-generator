<?php

namespace App\Services\HtmlTableGenerator\Tables;

use App\Services\HtmlTableGenerator\Column;
use App\Services\HtmlTableGenerator\HtmlTable;
use App\Services\HtmlTableGenerator\Repositories\BugloosApiRepository;
use App\Services\HtmlTableGenerator\Repositories\RepositoryInterface;

class CompanyTable extends HtmlTable
{
    protected function getRepository() : RepositoryInterface
    {
        return new BugloosApiRepository('companies');
    }

    protected function columns(): array
    {
        return [
            Column::make('Company Name','name')
                ->sortable()
                ->searchable()
                ->setDecorator(function (Object $entity) {
                    return $this->toHtml('<u>' . $entity->name . '</u>');
                }),

            Column::make('SAP number','sap_number')
                ->setWidth('25px'),

            Column::make('City and country','city')
                ->searchable()
                ->setDecorator(function (Object $entity) {
                    return $entity->city . ', ' . $entity->country;
                }),

            Column::make('Sub/dealer', 'dealer')
                ->setDecorator(function (Object $entity) {
                    return $entity->sub_company . ', ' . $entity->dealer;
                }),

            Column::make('Machines', 'machines')
                ->sortable(),

            Column::make('Active alarms/warnings', 'alarms')
                ->sortable()
                ->setDecorator(function (Object $entity) {
                    return $this->toHtml(
                        '<span class="badge badge-circle badge-danger">'.$entity->alarms.'</span>'.' '.
                        '<span class="badge badge-circle badge-warning">'.$entity->warnings.'</span>'
                    );
                }),

            Column::make('Status', 'status')
                ->sortable()
                ->setDecorator(function (Object $entity) {
                    return $this->getHtmlStatus($entity->status);
                }),
        ];
    }

    protected function heading(): string
    {
        return 'Companies - from API';
    }

}
