<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

/**when u access to /api in the web browser */
Route::get('/', function(){
    return 'Welcome to travel-api';
});

Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth:sanctum')->group(function(){
    Route::group(['prefix' => '/user'], function(){
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
        Route::patch('/{id}', [UserController::class, 'show'])->name('user.update');
        Route::delete('/{id}', [UserController::class, 'show'])->name('user.destroy');
    });

});
