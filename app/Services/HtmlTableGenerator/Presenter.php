<?php

namespace App\Services\HtmlTableGenerator;

use Illuminate\Support\Collection;
use stdClass;

class Presenter
{
    private Collection $collection;

    private array $columns;

    public function __construct(Collection $collection, array $columns)
    {
        $this->collection = $collection;
        $this->columns = $columns;
    }

    public function transform($row) : StdClass
    {
        $object = new StdClass;

        foreach ($this->columns as $column) {
            $object->{$column->getName()} = $column->isDecorated() ?
                                            $column->decorate($row, $column) :
                                            data_get($row, $column->getName());
        }

        return $object;
    }

    public function present() : Collection
    {
        $result = [];

        foreach ($this->collection as $row) {
            $result[] = $this->transform($row);
        }

        return collect($result);
    }
}
