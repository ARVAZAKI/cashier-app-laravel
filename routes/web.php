<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
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

Auth::routes();
//route item
Route::resource('/item',ItemController::class)->middleware('auth');
Route::get('/item/{id}/hapus', [ItemController::class, "hapus"])->name('item.hapus')->middleware('auth');
//route category
Route::resource('/category',CategoryController::class)->middleware('auth');
Route::get('/category/{id}/hapus', [CategoryController::class, "hapus"])->name('category.hapus')->middleware('auth');
//route transaction
Route::resource('/transaction',TransactionController::class)->middleware('auth');
Route::get('/history',[TransactionController::class, 'history'])->middleware('auth');
Route::post('/transaction/checkout', [TransactionController::class, 'checkout'])->name('transaction.checkout')->middleware('auth');
//route home
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
