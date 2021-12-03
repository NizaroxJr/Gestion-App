<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/

Route::group(['middleware' => ['web','tenancy.enforce']], function () {
    Auth::routes();
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
});

Route::group(['middleware' => ['web','auth', 'tenancy.enforce']], function() {
    $host = request()->getHttpHost();
    return view('tenants.admin',['host'=>$host]);
});

Route::group(['middleware' => ['web','auth', 'tenancy.enforce']], function() {
   Route::resource('products',ProductsController::class);
   Route::resource('category',CategoryController::class);
   Route::resource('supplier',SupplierController::class);
   Route::resource('order',OrderController::class);
   Route::resource('client',ClientController::class);
});