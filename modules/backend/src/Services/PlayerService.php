<?php

namespace NSO\Backend\Services;

use \Illuminate\Database\Eloquent\Builder;
use NSO\Backend\Helpers\Query;
use NSO\Models\Player;
use PDO;

class PlayerService
{
    public function __construct(protected Player $model) {}

    public function search($inputs)
    {
        $query = $this->model::query();
        $query->with([
            'user:id,username,newplay',
            'clazz:id,name',
        ]);
        $query->select([
            'id',
            'user_id',
            'name',
            'gender',
            'class',
            'data',
            'online',
            'yen',
            'xu',
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
            ['name', 'name'],
            ['class', 'class'],
            ['online', 'online'],
        ]);

        $filter->when('username', function (Builder $query, $username) {
            $query->whereHas('user', function ($query) use ($username) {
                $query->where('username', 'like', '%' . $username . '%');
            });
        });
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
        $player = $this->model::with([
            'user:id,username,luong',
            'clazz:id,name',
            'headPart'
        ])->find($id);

        return $player;
    }
}
