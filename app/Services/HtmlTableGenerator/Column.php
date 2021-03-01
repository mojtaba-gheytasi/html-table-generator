<?php

declare(strict_types=1);

namespace App\Services\HtmlTableGenerator;

class Column
{
    private string $displayName;

    private ?string $name = null;

    private bool $sortable = false;

    private bool $searchable = false;

    private ?string $width = null;

    private $formatCallback;

    public function __construct(string $displayName, string $name)
    {
        $this->displayName = $displayName;
        $this->name = $name;
    }

    public static function make(string $displayName, string $name) : self
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

    public function setWidth(string $width) : self
    {
        $this->width = $width;

        return $this;
    }

    public function hasCustomWidth() : bool
    {
        return $this->width !== null;
    }

    public function getWidth() : ?string
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
