<?php

namespace NSO\Backend\Traits;

use Illuminate\Support\Facades\Event;
use NSO\Backend\Events\Transaction;
use NSO\Backend\Listeners\CreateTransaction;

trait WithEvent
{
    public function registerEvents()
    {
        Event::listen(
            Transaction::class,
            CreateTransaction::class,
        );
    }
}
