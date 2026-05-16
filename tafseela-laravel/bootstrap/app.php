<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Core\Http\Middleware\EnforceJsonResponse;
use Modules\Core\Http\Middleware\SystemInjection;
use Modules\Core\Transformers\ActionsResponse;
use Modules\Identity\Http\Middleware\SetDefaultAuthGuard;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$fs = new Filesystem;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(EnforceJsonResponse::class);
        $middleware->append(SetDefaultAuthGuard::class);
        $middleware->append(SystemInjection::class);
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return null;
            }

            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            if ($request->is('api/*')) {
                return ActionsResponse::forbidden(__('Too many attempts, please try again later'));
            }
        });
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return ActionsResponse::forbidden();
            }
        });
        $exceptions->render(function (AccessDeniedHttpException $e, $request) {
            return ActionsResponse::forbidden();
        });
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                return new ActionsResponse(message: $e->getMessage(), statusCode: 422, errors: $e->errors());
            }
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return ActionsResponse::notFound();
            }
        });
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $throwable): bool {
            return $request->expectsJson() || $request->routeIs('api.*');
        });
    })
    ->create();
