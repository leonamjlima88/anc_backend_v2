<?php

use App\Modules\Stock\Unit\Controller\UnitController;
use Illuminate\Support\Facades\Route;

/**
 * Unit (Unidades de Medida)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'stock'
], function () {
  Route::get("unit",         [UnitController::class, 'index'])->name("general-unit.index");
  Route::post("unit",        [UnitController::class, 'store'])->name("general-unit.store");
  Route::get("unit/{id}",    [UnitController::class, 'show'])->name("general-unit.show");
  Route::put("unit/{id}",    [UnitController::class, 'update'])->name("general-unit.update");
  Route::delete("unit/{id}", [UnitController::class, 'destroy'])->name("general-unit.destroy");
  Route::post("unit/query",  [UnitController::class, 'query'])->name("general-unit.query");
});