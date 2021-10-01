<?php

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');

//Products Routes//
Route::middleware('auth')->group(function(){

    Route::get('/products',function(){
    
        return view('admin.products.products');
    })->name('products');

    Route::get('/products/add',function(){
    
        return view('admin.products.addProduct');
    })->name('products.add');
});