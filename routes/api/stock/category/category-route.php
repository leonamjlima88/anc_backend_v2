<?php

use App\Modules\Stock\Category\Controller\CategoryController;
use Illuminate\Support\Facades\Route;

/**
 * Category (Categorias)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'stock'
], function () {
  Route::get("category",         [CategoryController::class, 'index'])->name("general-category.index");
  Route::post("category",        [CategoryController::class, 'store'])->name("general-category.store");
  Route::get("category/{id}",    [CategoryController::class, 'show'])->name("general-category.show");
  Route::put("category/{id}",    [CategoryController::class, 'update'])->name("general-category.update");
  Route::delete("category/{id}", [CategoryController::class, 'destroy'])->name("general-category.destroy");
  Route::post("category/query",  [CategoryController::class, 'query'])->name("general-category.query");
});