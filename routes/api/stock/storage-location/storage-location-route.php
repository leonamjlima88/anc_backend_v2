<?php

use App\Modules\Stock\StorageLocation\Controller\StorageLocationController;
use Illuminate\Support\Facades\Route;

/**
 * StorageLocation (Local de Armazenamento)
 */
Route::group([
  // 'middleware' => [ 'X-Locale', 'jwt' ],
  'middleware' => [ 'X-Locale' ],
  'prefix' => 'stock'
], function () {
  Route::get("storage-location",         [StorageLocationController::class, 'index'])->name("general-storage-location.index");
  Route::post("storage-location",        [StorageLocationController::class, 'store'])->name("general-storage-location.store");
  Route::get("storage-location/{id}",    [StorageLocationController::class, 'show'])->name("general-storage-location.show");
  Route::put("storage-location/{id}",    [StorageLocationController::class, 'update'])->name("general-storage-location.update");
  Route::delete("storage-location/{id}", [StorageLocationController::class, 'destroy'])->name("general-storage-location.destroy");
  Route::post("storage-location/query",  [StorageLocationController::class, 'query'])->name("general-storage-location.query");
});