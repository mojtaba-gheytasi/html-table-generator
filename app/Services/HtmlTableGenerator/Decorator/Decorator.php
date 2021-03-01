<?php

declare(strict_types=1);

namespace App\Services\HtmlTableGenerator\Decorator;

use Illuminate\Support\Collection;
use stdClass;

class Decorator
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
            $object->{$column->getDisplayName()} = $column->isDecorated() ?
                                            $column->decorate($row, $column) :
                                            data_get($row, $column->getName());
        }

        return $object;
    }

    public function decorate() : Collection
    {
        $result = [];

        foreach ($this->collection as $row) {
            $result[] = $this->transform($row);
        }

        return collect($result);
    }
}
