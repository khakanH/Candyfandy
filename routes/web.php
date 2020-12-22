<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;

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
Route::get('get-new-order',[OrderController::class, 'NewOrders'])->name('get-new-order');
Route::get('accept-order/{id}',[OrderController::class, 'AcceptOrder'])->name('accept-order');
Route::get('reject-order/{id}',[OrderController::class, 'RejectOrder'])->name('reject-order');
Route::get('complete-order/{id}',[OrderController::class, 'CompleteOrder'])->name('complete-order');

Route::get('search-order/{val}',[OrderController::class, 'SearchOrder'])->name('search-order');

Route::get('get-accepted-order',[OrderController::class, 'AcceptedOrderList'])->name('get-accepted-order');
Route::get('get-completed-order',[OrderController::class, 'CompletedOrderList'])->name('get-completed-order');
Route::get('get-rejected-order',[OrderController::class, 'RejectedOrderList'])->name('get-rejected-order');







Route::get('sale',[SaleController::class, 'Index'])->name('sale');


Route::get('user',[UserController::class, 'Index'])->name('user');
Route::post('add-update-user',[UserController::class, 'AddUpdateUser'])->name('add-update-user');
Route::get('get-user-type-name-list/{type}',[UserController::class, 'UserTypeNameList'])->name('get-user-type-name-list');


Route::get('user-type',[UserController::class, 'UserType'])->name('user-type');
Route::get('delete-user-type/{id}',[UserController::class, 'DeleteUserType'])->name('delete-user-type');
Route::post('add-update-user-type',[UserController::class, 'AddUpdateUserType'])->name('add-update-user-type');
Route::get('get-user-type-list-AJAX',[UserController::class, 'UserTypeListAJAX'])->name('get-user-type-list-AJAX');
