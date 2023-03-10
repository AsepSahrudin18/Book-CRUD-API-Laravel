<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// import controllers
use App\Http\Controllers\{
    Books\BookController,
    Auth\AuthController,
};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function(){
    Route::resource('books', BookController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/**
 * Route authentication
 * - register
 * - login
 * - logout
 */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);