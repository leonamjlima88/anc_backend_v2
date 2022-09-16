<?php

use Illuminate\Support\Facades\Route;

/**
 * User (Usuário)
 */
Route::group([
  // 'middleware' => [
  //   'api', 
  //   env('AUTH'),
  //   'acl',
  //   'X-Locale'
  // ],
  // 'namespace' => 'App\Modules\User\Adapter\Controller'
  'namespace' => 'App\Http\Controllers'
  // 'prefix' => 'stock',
], function () {
  Route::post("/user/auth",         "UserController@auth")->name("user.auth");
  // Route::get("/user",         "UserController@index")->name("user.index");
  // Route::post("/user",        "UserController@store")->name("user.store");
  // Route::get("/user/{id}",    "UserController@show")->name("user.show");
  // Route::put("/user/{id}",    "UserController@update")->name("user.update");
  // Route::delete("/user/{id}", "UserController@destroy")->name("user.destroy");
});