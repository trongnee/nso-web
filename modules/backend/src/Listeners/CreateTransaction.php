<?php

namespace NSO\Backend\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use NSO\Backend\Events\Transaction as Event;
use NSO\Models\Transaction;

class CreateTransaction
{
    public function handle(Event $event)
    {
        DB::beginTransaction();
        $user = $event->user;
        $payload = $event->payload;
        $auth = auth('admin')->user();
        $now = Carbon::now();

        try {
            $data = [
                'user_id' => $payload['user_id'],
                'type' => $payload['type'],
                'amount' => $payload['amount'],
                'date' => $now,
                'description' => $payload['description'],
                'pre_balance' => $payload['pre_balance'],
                'new_balance' => $user->balance,
                'status' => 'completed',
                'created_by' => $auth->id,
            ];
            Transaction::query()->create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
