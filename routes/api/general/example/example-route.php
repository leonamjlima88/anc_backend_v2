<?php

use App\Modules\General\Example\Controller\ExampleController;
use Illuminate\Support\Facades\Route;

/**
 * Example (Exemplo)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'general'
], function () {
  Route::get("example",         [ExampleController::class, 'index'])->name("general-example.index");
  Route::post("example",        [ExampleController::class, 'store'])->name("general-example.store");
  Route::get("example/{id}",    [ExampleController::class, 'show'])->name("general-example.show");
  Route::put("example/{id}",    [ExampleController::class, 'update'])->name("general-example.update");
  Route::delete("example/{id}", [ExampleController::class, 'destroy'])->name("general-example.destroy");
  Route::post("example/query",  [ExampleController::class, 'query'])->name("general-example.query");
});