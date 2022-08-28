<?php

use App\Modules\Stock\Size\Controller\SizeController;
use Illuminate\Support\Facades\Route;

/**
 * Size (Tamanho)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'stock'
], function () {
  Route::get("size",         [SizeController::class, 'index'])->name("general-size.index");
  Route::post("size",        [SizeController::class, 'store'])->name("general-size.store");
  Route::get("size/{id}",    [SizeController::class, 'show'])->name("general-size.show");
  Route::put("size/{id}",    [SizeController::class, 'update'])->name("general-size.update");
  Route::delete("size/{id}", [SizeController::class, 'destroy'])->name("general-size.destroy");
  Route::post("size/query",  [SizeController::class, 'query'])->name("general-size.query");
});