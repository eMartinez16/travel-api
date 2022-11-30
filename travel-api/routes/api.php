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
    Route::controller(UserController::class)->prefix('user')->group(function(){
        Route::get('/', 'index')->name('user.index');
        Route::get('/{id}', 'show')->name('user.show');
        Route::patch('/{id}', 'show')->name('user.update');
        Route::delete('/{id}', 'show')->name('user.destroy');
    });

});
