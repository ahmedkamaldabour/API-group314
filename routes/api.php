<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:sanctum');


Route::group(
    [
        'prefix' => 'products',
        'as' => 'products.',
        'controller' => ProductController::class,
        'middleware' => ['auth:sanctum']
    ]
    ,
    function () {
        Route::get('/','index')->name('index');
        // route show
        Route::get('/{id}','show')->name('show');
        // route store
        Route::post('/','store')->name('store');
        // route update
        Route::put('/{id}','update')->name('update');
        // route delete
        Route::delete('/{id}','destroy')->name('destroy');
    }
);
