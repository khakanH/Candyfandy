<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;

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
    return view('signin');
})->name('index');


Route::post('signin', [AccountController::class, 'Sigin'])->name('signin');

Route::get('signout', [AccountController::class, 'SignOut'])->name('signout');





Route::get('dashboard',[DashboardController::class, 'Index'])->name('dashboard');


Route::get('category',[InventoryController::class, 'CategoryList'])->name('category');
Route::post('add-update-category',[InventoryController::class, 'AddUpdateCategory'])->name('add-update-category');
Route::get('get-category-list-AJAX',[InventoryController::class, 'CategoryListAJAX'])->name('get-category-list-AJAX');
Route::get('change-category-availability/{id}/{val}',[InventoryController::class, 'ChangeCategoryAvailability'])->name('change-category-availability');
Route::get('delete-category/{id}',[InventoryController::class, 'DeleteCategory'])->name('delete-category');




Route::get('product',[InventoryController::class, 'ProductList'])->name('product');
Route::post('add-update-product',[InventoryController::class, 'AddUpdateProduct'])->name('add-update-product');
Route::get('get-product-list-AJAX',[InventoryController::class, 'ProductListAJAX'])->name('get-product-list-AJAX');
Route::get('get-category-name-list/{id}',[InventoryController::class, 'CategoryNameList'])->name('get-category-name-list');
Route::get('change-product-availability/{id}/{val}',[InventoryController::class, 'ChangeProductAvailability'])->name('change-product-availability');
Route::get('delete-product/{id}',[InventoryController::class, 'DeleteProduct'])->name('delete-product');



Route::get('order',[OrderController::class, 'Index'])->name('order');
Route::get('sale',[SaleController::class, 'Index'])->name('sale');
