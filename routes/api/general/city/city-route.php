<?php

use App\Modules\General\City\Controller\CityController;
use Illuminate\Support\Facades\Route;

/**
 * City (Cidade)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'general'
], function () {
  Route::get("city",         [CityController::class, 'index'])->name("general-city.index");
  Route::get("city/{id}",    [CityController::class, 'show'])->name("general-city.show");
  Route::post("city/query",  [CityController::class, 'query'])->name("general-city.query");
});