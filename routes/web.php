<?php

use App\Http\Controllers\Admin\CanteenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('profile', ProfileController::class);

Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
            Route::resource('profile', ProfileController::class);

            Route::resource('canteen', CanteenController::class);
            Route::get('/customer/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customer.show');
            Route::post('/customer/store', [\App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customer.store');
        });
    });
});