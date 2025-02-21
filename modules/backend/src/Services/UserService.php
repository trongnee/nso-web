<?php

namespace NSO\Backend\Services;

use NSO\Models\User;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use NSO\Backend\Events\Transaction;
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
        $user = $this->model::with([
            'player:id,user_id,data,name,class,xu,yen,gender',
            'player.clazz',
        ])->find($id);

        return $user;
    }

    public function updateBalance($inputs)
    {
        $user = $this->model->find($inputs['user_id']);
        $operator = $inputs['type'] === 'credit' ? 1 : -1;

        $pre_balance = $user->balance;
        $new_balance = $user->balance + $inputs['amount'] * $operator;

        $data_update = [
            'balance' => $new_balance,
        ];
        if ($operator === 1) {
            $data_update['tongnap'] = $user->tongnap + $inputs['amount'];
        }
        DB::beginTransaction();
        try {
            $user->update($data_update);
            Transaction::dispatch(
                $user,
                [
                    ...$inputs,
                    'pre_balance' => $pre_balance
                ]
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function updateUser($inputs)
    {
        $user = $this->model->find($inputs['user_id']);

        $data = [
            'username' => $inputs['username'],
            'phone' => $inputs['phone'],
            'status' => $inputs['status'],
            'activated' => $inputs['activated'],
        ];
        if (filled($inputs['password'])) {
            $data['password'] = Hash::make($inputs['password']);
        }
        $user->update($data);
    }
}
