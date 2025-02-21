<?php

namespace NSO\Backend\Events;

use Illuminate\Foundation\Events\Dispatchable;
use NSO\Models\User;

class Transaction
{
    use Dispatchable;
    public array $payload = [];
    public function __construct(
        public User $user,
        $data
    ) {
        $this->payload = $data;
    }
}
