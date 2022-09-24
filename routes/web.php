<?php

use App\Http\Controllers\{
    AddressController,
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

Route::get('/', [UserController::class, 'index'])->name('users.index');

Route::post('/auth', [UserController::class, 'auth'])->name('users.auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/address', [AddressController::class, 'index'])->name('address.index');  
});