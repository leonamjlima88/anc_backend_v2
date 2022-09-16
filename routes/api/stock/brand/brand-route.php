<?php

use App\Modules\Stock\Brand\Controller\BrandController;
use Illuminate\Support\Facades\Route;

/**
 * Brand (Marca)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'stock'
], function () {
  Route::get("brand",         [BrandController::class, 'index'])->name("general-brand.index");
  Route::post("brand",        [BrandController::class, 'store'])->name("general-brand.store");
  Route::get("brand/{id}",    [BrandController::class, 'show'])->name("general-brand.show");
  Route::put("brand/{id}",    [BrandController::class, 'update'])->name("general-brand.update");
  Route::delete("brand/{id}", [BrandController::class, 'destroy'])->name("general-brand.destroy");
  Route::post("brand/query",  [BrandController::class, 'query'])->name("general-brand.query");
});