<?php

namespace Omarashi\LaravelDatatables;

use Illuminate\Support\Str;
use Omarashi\LaravelDatatables\Forms\ColumnForm;

class Column
{
    protected array $column;
    protected string $title;
    protected string $name;
    protected string $data;
    protected string $html;
    protected bool $orderable;
    protected bool $hidden;
    protected array $editable;
    protected array $filter;

    public static function name($value): self
    {
        $column = new static;
        $column->name = $value;
        $column->column['name'] = $value;

        $column->orderable = true;
        $column->column['orderable'] = true;

        $column->hidden = false;
        $column->column['hidden'] = false;

        if (Str::contains($value, ' as ')) {
            $exploded = explode(' as ', $value);

            $column->name = trim($exploded[0]);
            $column->column['name'] = trim($exploded[0]);

            $column->data = trim($exploded[1]);
            $column->column['data'] = trim($exploded[1]);
        } else {
            $column->data = $value;
            $column->column['data'] = $value;
        }
        return $column;
    }

    public function title(string $value): self
    {
        $this->title = $value;
        $this->column['title'] = $value;
        return $this;
    }

    public function editable(array $value): self
    {
        $this->editable = $value;
        $this->column['editable'] = $value;
        return $this;
    }

    public function filterable(array $value): self
    {
        $this->filter = $value;
        $this->column['filter'] = $value;
        return $this;
    }

    public function html($html): self
    {
        $this->html = $html;
        $this->column['html'] = $html;
        return $this;
    }

    public function orderable(bool $value = true): self
    {
        $this->orderable = $value;
        $this->column['orderable'] = $value;
        return $this;
    }

    public function hidden(bool $value = true): self
    {
        $this->hidden = $value;
        $this->column['hidden'] = $value;
        return $this;
    }

    public function add(): array
    {
        return $this->column;
    }
}
