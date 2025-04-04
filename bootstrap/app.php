<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'superadmin' => \App\Http\Middleware\SuperAdmin::class,
            'unverifiedagent' => \App\Http\Middleware\UnverifiedAgent::class,
            'user' => \App\Http\Middleware\User::class,
            'agent' => \App\Http\Middleware\Agent::class,
            'teacher' => \App\Http\Middleware\Teacher::class,
            'status' => \App\Http\Middleware\CheckUserStatus::class,
            'PDF' => Barryvdh\DomPDF\Facade\Pdf::class,
            'role' => \App\Http\Middleware\Role::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
