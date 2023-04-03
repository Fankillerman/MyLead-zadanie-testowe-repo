<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth'], 'prefix' => 'products'], function () {
    Route::post('save', [ProductController::class, 'save'])->name('product-save');
    Route::get('create', [ProductController::class, 'create'])->name('product-create');

    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product-edit');
    Route::put('update/{id}', [ProductController::class, 'update'])->name('product-store');
    Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('product-delete');
});
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product-show');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
