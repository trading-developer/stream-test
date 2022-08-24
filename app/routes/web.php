<?php

use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], static function () {
    Route::get('/{page?}', [IndexController::class, 'indexAction'])
        ->where(['page' => '[0-9]+'])
        ->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        Route::get('/register', [RegisterController::class, 'showAction'])->name('register.show');
        Route::post('/register', [RegisterController::class, 'registerAction'])->name('register.perform');
        Route::get('/login', [LoginController::class, 'showAction'])->name('login');
        Route::post('/login', [LoginController::class, 'loginAction'])->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', [LogoutController::class, 'logoutAction'])->name('logout.logout');
        Route::get('/broadcast/show/{id}', [BroadcastController::class, 'showAction'])
            ->where(['id' => '[0-9]+'])
            ->name('broadcast.show');

        Route::get('/broadcast/create', [BroadcastController::class, 'showCreateAction'])
            ->name('broadcast.showCreate');

        Route::post('/broadcast/create', [BroadcastController::class, 'createAction'])
            ->name('broadcast.create');
    });
});




