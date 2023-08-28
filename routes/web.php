<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductConctroller;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Product;
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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::view('login', 'admin.login')->name('login');
    Route::post('login/attempt',[AdminController::class,'login'])->name('login.attempt');
    Route::get('logout',[AdminController::class,'logout'])->name('logout');

    Route::view('index', 'admin.index')->name('index');

    //------category routes
    Route::view('category/create', 'admin.category.create')->name('category.create');
    Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('category/index',[CategoryController::class,'index'])->name('category.index');
    Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('category/update',[CategoryController::class,'update'])->name('category.update');
    Route::post('category/delete',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('category/product/{id}',[CategoryController::class,'products'])->name('category.products');

    //--------sub category routes
    Route::view('subcategory/create', 'admin.subcategory.create')->name('subcategory.create');
    Route::post('subcategory/store',[SubCategoryController::class,'store'])->name('subcategory.store');
    Route::get('subcategory.index',[SubCategoryController::class,'index'])->name('subcategory.index');
    Route::get('subcategory/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
    Route::post('subcategory/update',[SubCategoryController::class,'update'])->name('subcategory.update');
    Route::post('subcategory/delete',[SubCategoryController::class,'delete'])->name('subcategory.delete');
    Route::get('subcategory/product/{id}',[SubCategoryController::class,'products'])->name('subcategory.products');

    //----------product routes
    Route::view('product/create','admin.product.create')->name('product.create');
    Route::post('product/subcategory/get',[CategoryController::class,'subcat'])->name('product.subcategory');
    Route::post('product/store',[ProductConctroller::class,'store'])->name('product.store');
    Route::get('product/index',[ProductConctroller::class,'index'])->name('product.index');
    Route::post('product/delete',[ProductConctroller::class,'delete'])->name('product.delete');
    Route::post('product/edit',[ProductConctroller::class,'edit'])->name('product.edit');
    Route::post('product/update',[ProductConctroller::class,'update'])->name('product.update');
    Route::get('product/limited',[ProductConctroller::class,'limited'])->name('product.limited');

    //------------sales routes
    Route::view('sales/create','admin.sales.create')->name('sales.create');
    Route::post('subcategory/products',[SaleController::class,'products'])->name('sales.subcategory.products');
    Route::post('product/details',[SaleController::class,'productDetails'])->name('sales.product.details');
    Route::post('sales/store',[SaleController::class,'store'])->name('sales.store');
    Route::view('sales/index','admin.sales.index')->name('sales.index');
    Route::post('sales/graph',[SaleController::class,'graph'])->name('sales.graph');
    Route::get('sales/all',[SaleController::class,'all_sales'])->name('sales.all');
    Route::get('sales/items/{id}',[SaleController::class,'show_items'])->name('sales.items');
    Route::get('sales/invoice/{id}',[SaleController::class,'invoice'])->name('sales.invoice');
    
});
