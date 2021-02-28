<?php

namespace App\Services\HtmlTableGenerator;

use Illuminate\Support\Str;

class Column
{
    private string $displayName;

    private string $name;

    private bool $sortable = false;

    private bool $searchable = false;

    private ?int $width = null;

    private $formatCallback;

    public function __construct(string $displayName, ?string $name)
    {
        $this->displayName = $displayName;
        $this->name = $name ?? Str::snake(Str::lower($displayName));
    }

    public static function make(string $displayName, ?string $name = null) : self
    {
        return new static($displayName, $name);
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getDisplayName() : string
    {
        return $this->displayName;
    }

    public function sortable() : self
    {
        $this->sortable = true;

        return $this;
    }

    public function isSortable() : bool
    {
        return $this->sortable === true;
    }

    public function searchable() : self
    {
        $this->searchable = true;

        return $this;
    }

    public function isSearchable() : bool
    {
        return $this->searchable === true;
    }

    public function setWidth(int $width) : self
    {
        $this->width = $width;

        return $this;
    }

    public function hasCustomWidth() : bool
    {
        return $this->width !== null;
    }

    public function getWidth() : ?int
    {
        return $this->width;
    }

    public function setDecorator(callable $callable) : self
    {
        $this->formatCallback = $callable;

        return $this;
    }

    public function isDecorated(): bool
    {
        return is_callable($this->formatCallback);
    }

    public function decorate(Object $entity, $column)
    {
        return call_user_func_array(
            $this->formatCallback,
            ['entity' => $entity, 'column' => $column]
        );
    }
}
