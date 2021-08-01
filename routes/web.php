<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/customers', [App\Http\Controllers\PageController::class, 'index'])->name('customers');
Route::get('/customers', [App\Http\Controllers\PageController::class, 'CustomersDatatable'])->name('customers.datatables');
Route::get('/products', [App\Http\Controllers\PageController::class, 'ProductsDatatable'])->name('products.datatables');
Route::get('/orders', [App\Http\Controllers\PageController::class, 'OrdersDatatable'])->name('orders.datatables');
Route::get('/change_stock/{id}', [App\Http\Controllers\PageController::class, 'ChangeStock'])->name('change.stock');
Route::get('/order_details/{id}', [App\Http\Controllers\PageController::class, 'OrderDetails'])->name('order.details');




