<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Permission;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Spatie\Permission\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    api: __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
    apiPrefix: '/api',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
      'role' => RoleMiddleware::class,
      'permission' => Permission::class,
      'role_or_permission' => RoleOrPermissionMiddleware::class,
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (AuthenticationException $e, Request $request) {
      if ($request->is('api/*')) {
        return response()->json([
          'message' => $e->getMessage(),
        ], 401);
      }
    });
  })->create();
