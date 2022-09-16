<?php

use App\Modules\Stock\Product\Adapter\Controller\ProductController;
use Illuminate\Support\Facades\Route;

/**
 * Product (Estoque)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'stock'
], function () {
  Route::get("product",         [ProductController::class, 'index'])->name("stock-product.index");
  Route::post("product",        [ProductController::class, 'store'])->name("stock-product.store");
  Route::get("product/{id}",    [ProductController::class, 'show'])->name("stock-product.show");
  Route::put("product/{id}",    [ProductController::class, 'update'])->name("stock-product.update");
  Route::delete("product/{id}", [ProductController::class, 'destroy'])->name("stock-product.destroy");
  Route::post("product/query",  [ProductController::class, 'query'])->name("stock-product.query");
});