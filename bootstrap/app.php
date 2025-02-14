<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->redirectGuestsTo(function () {
            $list = request()->route()->gatherMiddleware();
            $is_admin = in_array('auth:admin', $list);
            return route($is_admin ? 'admin.login' : 'login');
        });

        $middleware->redirectUsersTo(function () {
            $list = request()->route()->gatherMiddleware();
            $is_admin = in_array('guest:admin', $list);
            return $is_admin ? route('admin.dashboard') : '/';
        });
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
