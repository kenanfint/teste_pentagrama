<?php

use App\Http\Controllers\{
    CityController,
    UserController
};
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'login'])->name('users.login');
Route::get('/register', [UserController::class, 'register'])->name('users.register');

Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::post('/auth', [UserController::class, 'auth'])->name('users.auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/city', [CityController::class, 'index'])->name('cities.index');
    Route::get('/city/store', [CityController::class, 'store'])->name('cities.store');

    Route::post('/city/filter', [CityController::class, 'filter'])->name('cities.filter');

    Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');
});
