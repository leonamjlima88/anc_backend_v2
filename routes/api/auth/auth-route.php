<?php

use App\Modules\Auth\Adapter\Controller\AuthController;
use Illuminate\Support\Facades\Route;

$group = [
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'auth'
];
if (env('AUTH')) array_push($group['middleware'], env('AUTH'));

/**
 * Auth (Autenticação)
 */
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);
Route::group($group, function () {
    Route::post('logout', [AuthController::class, 'logout'])->name("auth-logout.index");
    Route::post('refresh', [AuthController::class, 'refresh'])->name("auth-refresh.index");
    Route::post('me', [AuthController::class, 'me'])->name("auth-me.index");
  }
);