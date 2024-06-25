<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//   return $request->user();
// })->middleware('auth:sanctum');

Route::group([
  'middleware' => 'api',
  'prefix' => 'auth',
], function () {
  Route::post('register', [AuthController::class, 'register'])->name('register');
  Route::post('login', [AuthController::class, 'login'])->name('login');

  Route::middleware([
    'auth:api'
  ])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');
  });
});
