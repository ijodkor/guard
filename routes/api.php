<?php

use Ijodkor\Guard\Http\Controllers\Rbac\PositionController;
use Ijodkor\Guard\Http\Controllers\Rbac\RoleController;
use Ijodkor\Guard\Http\Controllers\Rbac\UserRoleController;
use Ijodkor\Guard\Http\Controllers\User\OrganizationController;
use Ijodkor\Guard\Http\Controllers\User\UserController;
use Ijodkor\Guard\Http\Middlewares\RoleHasMiddleware;
use Ijodkor\Guard\Http\Middlewares\RoleHasPositionMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('/api/guard')->group(function() {

    Route::middleware(['auth:api', RoleHasMiddleware::class, RoleHasPositionMiddleware::class])->group(function() {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('positions', PositionController::class);

        Route::prefix('users')->group(function() {
            Route::get('{user}/roles', [UserRoleController::class, 'index']);
            Route::post('{user}/role/assign', [UserRoleController::class, 'store']);
            Route::post('{user}/role/deprive', [UserRoleController::class, 'destroy']);
        });

        Route::apiResource('users', UserController::class);
        Route::apiResource('organizations', OrganizationController::class);
    });
});
