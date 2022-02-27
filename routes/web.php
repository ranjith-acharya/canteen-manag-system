<?php

use App\Http\Controllers\Admin\CanteenController;
use App\Http\Controllers\Admin\FoodItemController;
use App\Http\Controllers\OrderController;
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
Route::resource('/canteen', App\Http\Controllers\CanteenController::class);
Route::resource('/order', OrderController::class);
Route::get('/markRead', [App\Http\Controllers\Admin\NotificationController::class, 'markRead'])->name('markRead');

Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
            Route::resource('profile', ProfileController::class);

            Route::resource('order', OrderController::class);
            Route::post('order/status', [App\Http\Controllers\OrderController::class, 'setStatus'])->name('set.order.status');

            Route::resource('canteen', CanteenController::class);
            Route::post('canteen/status', [App\Http\Controllers\Admin\CanteenController::class, 'setStatus'])->name('set.status');
            Route::resource('food', FoodItemController::class);
            Route::get('/customer/{customer}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customer.show');
            Route::post('/customer/store', [\App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customer.store');

            Route::get('/markRead', [App\Http\Controllers\Admin\NotificationController::class, 'markRead'])->name('markRead');
        });
    });
});