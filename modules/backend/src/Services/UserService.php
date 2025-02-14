<?php

namespace NSO\Backend\Services;

use NSO\Models\User;
use \Illuminate\Database\Eloquent\Builder;
use NSO\Backend\Helpers\Query;

class UserService
{
    public function __construct(protected User $model) {}

    public function search($inputs)
    {
        $query = $this->model::query();
        $query->select([
            'id',
            'username',
            'phone',
            'activated',
            'status',
            'online',
        ]);
        $this->addFilter($query, $inputs);
        $this->order($query, $inputs);

        return $query->paginate(
            perPage: $inputs['perPage'],
            page: $inputs['page']
        );
    }

    private function addFilter(Builder $query, $inputs)
    {
        $filter = new Query($query, $inputs);
        $filter->applyConditions([
            ['username', 'username'],
            ['phone', 'phone'],
            ['activated', 'activated'],
            ['status', 'status'],
            ['online', 'online'],
        ]);
    }

    private function order(Builder $query, $inputs)
    {
        foreach ($inputs['order'] as $order) {
            $column_index = $order['column'];
            $query->orderBy($inputs['columns'][$column_index]['data'], $order['dir']);
        }
    }

    public function show($id)
    {
        return $this->model::find($id);
    }
}
