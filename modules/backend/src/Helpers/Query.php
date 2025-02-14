<?php

namespace NSO\Backend\Helpers;

use \Illuminate\Database\Eloquent\Builder;
use NSO\Backend\Enums\Operator;

class Query
{
    public function __construct(
        protected Builder $query,
        protected array $inputs
    ) {}

    /**
     * Apply a condition to the query if the given key exists in inputs.
     *
     * @param string $key The key to check in inputs.
     * @param string $column The database column to query.
     * @param Operator $operator The operator to use (default: EQUAL).
     * @param callable|null $replace Optional callable to modify the value.
     * @return static
     */
    public function when(
        string $key,
        string $column,
        Operator $operator = Operator::EQUAL,
        callable $replace = null
    ) {
        $query_mothod = $this->getQueryMethod($operator);

        $value = data_get($this->inputs, $key);

        if (filled($value)) {
            $this->query->{$query_mothod}(
                $column,
                $operator->value,
                $this->processValue($value, $operator, $replace)
            );
        }

        return $this;
    }

    public function order($column, $direction = 'asc'): static
    {
        $this->query->orderBy($column, $direction);
        return $this;
    }

    public function applyConditions(array $conditions): static
    {
        foreach ($conditions as $condition) {
            if (!is_array($condition) || count($condition) < 2) {
                throw new \InvalidArgumentException('Invalid condition format. Each condition must have at least [key, column].');
            }
            [$key, $column, $operator, $replace] = array_pad($condition, 4, null);
            $operator = $operator ?? Operator::EQUAL;
            $this->when($key, $column, $operator, $replace);
        }

        return $this;
    }

    protected function getQueryMethod(Operator $operator): string
    {
        return match ($operator) {
            Operator::IN => 'whereIn',
            Operator::NOT_IN => 'whereNotIn',
            default => 'where',
        };
    }

    protected function processValue($value, Operator $operator, ?callable $replace): mixed
    {
        if (is_null($value)) {
            return null;
        }

        if ($operator === Operator::LIKE) {
            $value = '%' . $value . '%';
        }
        return $replace ? $replace($value) : $value;
    }
}
