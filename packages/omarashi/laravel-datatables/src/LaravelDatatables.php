<?php

namespace Omarashi\LaravelDatatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class LaravelDatatables
{
    protected array $columns;
    protected mixed $query;
    protected array $searchExcepted = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public static function eloquent($query): self
    {
        $datatable = new static;
        $datatable->query = $query;
        return $datatable;
    }

    public function columns($columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    public function exceptFromSearch($columns)
    {
        $this->searchExcepted = array_merge($this->searchExcepted, $columns);
        return $this;
    }

    public function make()
    {
        $query = $this->query;
        $pageLength = (intval(request('pageLength')) === -1) ? $query->count() : request('pageLength');
        $this->applyOrderBy();
        $this->applyFilters();
        $this->applySearch();
        return [
            'page' => intval(request('page')) ?? 1,
            'columns' => $this->columns,
            'query' => $this->query->paginate($pageLength)->onEachSide(1)->toArray(),
        ];
    }

    public function json()
    {
        return response()->json($this->make(), 201);
    }

    protected function applyOrderBy(): void
    {
        if (request('orderBy')) {
            $orderBy = $this->toArray(request('orderBy'));
            if ($orderBy['column'])
                $this->query->orderBy($orderBy['column'], $orderBy['dir']);
        }
    }

    protected function applySearch(): void
    {
        if (request('search')) {
            $this->query->where(function ($query) {
//                $columns = Schema::getColumnListing($this->query->getModel()->getTable());
                $columns = $this->query->getQuery()->columns;
//                $firstCol = true;
                $whereConditions = [];
                foreach ($columns as $column) {
                    if ($column instanceof Expression) {
                        $column = $column->getValue(DB::getQueryGrammar());
                    }
                    if (Str::contains(implode(' , ', $this->searchExcepted), $column)) {
                        $column = $this->checkIfJsonColumn($column);
                        $whereConditions[] = "LOWER($column) LIKE '" . mb_strtolower('%' . trim(request('search')) . '%') . "'";
                    }
                }
                if (count($whereConditions) > 0)
                    $query->whereRaw(implode(' OR ', $whereConditions));
            });

        }
    }

    protected function applyFilters(): void
    {
        if (request('filters')) {
            $filters = $this->toArray(request('filters'));
            foreach ($filters as $key => $value) {
                if ($value and $value !== '') {
                    if (is_array($value)) {
                        $this->query->whereIn($key, Arr::pluck($value, 'value'));
                    } else {
                        $column = $this->checkIfJsonColumn($key);
                        $this->query->whereRaw('LOWER(' . $this->query->getModel()->getTable() . '.' . $column . ') LIKE ?', [mb_strtolower('%' . trim($value) . '%')]);
                    }
                }
            }
        }
    }

    private function checkIfJsonColumn($column)
    {
        $column = Str::lower($column);
        if (Str::contains($column, 'as'))
            $column = explode(' as', $column)[0];
        if (Str::contains($column, '->')) {
            $column = explode('->', $column);
            $column = $column[0] . '->"$.' . $column[1] . '"';
        }
        return $column;
    }

    private function toArray($param)
    {
        if (!is_array($param))
            return json_decode($param, true);
        return $param;
    }
}
