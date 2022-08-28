<?php

use App\Modules\General\State\Controller\StateController;
use Illuminate\Support\Facades\Route;

/**
 * State (Estado)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'general'
], function () {
  Route::get("state",         [StateController::class, 'index'])->name("general-state.index");
  Route::get("state/{id}",    [StateController::class, 'show'])->name("general-state.show");
  Route::post("state/query",  [StateController::class, 'query'])->name("general-state.query");
});