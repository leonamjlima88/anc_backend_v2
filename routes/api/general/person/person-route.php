<?php

use App\Modules\General\Person\Controller\PersonController;
use Illuminate\Support\Facades\Route;

/**
 * Person (Pessoa)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'general'
], function () {
  Route::get("person",         [PersonController::class, 'index'])->name("general-person.index");
  Route::post("person",        [PersonController::class, 'store'])->name("general-person.store");
  Route::get("person/{id}",    [PersonController::class, 'show'])->name("general-person.show");
  Route::put("person/{id}",    [PersonController::class, 'update'])->name("general-person.update");
  Route::delete("person/{id}", [PersonController::class, 'destroy'])->name("general-person.destroy");
  Route::post("person/query",  [PersonController::class, 'query'])->name("general-person.query");
});