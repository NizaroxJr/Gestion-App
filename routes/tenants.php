<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionsPaymentController;
use App\Http\Controllers\PlanController;
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

Route::group(['middleware' => ['web','auth', 'tenancy.enforce','subscribed']], function() {
    $host = request()->getHttpHost();
    return view('tenants.admin',['host'=>$host]);
});

Route::group(['middleware' => ['web','auth', 'tenancy.enforce','subscribed']], function() {
   //Inventory Routes
   Route::resource('products',ProductsController::class);
   Route::resource('category',CategoryController::class);
   Route::resource('warehouse',WarehouseController::class); 
   //Sales Routes
   Route::resource('order',OrderController::class);
   Route::get('/order/download/{id}', [OrderController::class, 'savePDF']);
   Route::get('/order/viewpdf/{id}', [OrderController::class, 'openPDF']);
      //Invoice Routes
   Route::resource('invoice',InvoiceController::class);
   Route::get('/invoice/download/{id}', [InvoiceController::class, 'savePDF']);
   Route::get('/invoice/viewpdf/{id}', [InvoiceController::class, 'openPDF']); 
   Route::get('/invoice/get/{id1}', [InvoiceController::class, 'ajaxAdd']);
   Route::get('/invoice/{id1}/get/{id2}', [InvoiceController::class, 'ajaxEdit']);
   Route::resource('client',ClientController::class);
   //Purchase Routes
   Route::resource('purchaseOrder',PurchaseOrderController::class);
   Route::get('/purchaseOrder/download/{id}', [PurchaseOrderController::class, 'savePDF']);
   Route::get('/purchaseOrder/viewpdf/{id}', [PurchaseOrderController::class, 'openPDF']);
   Route::resource('supplier',SupplierController::class);
      //Bills Routes
   Route::resource('bill',BillController::class);
   Route::get('/bill/download/{id}', [BillController::class, 'savePDF']);
   Route::get('/bill/viewpdf/{id}', [BillController::class, 'openPDF']);
   Route::get('/bill/get/{id1}', [BillController::class, 'ajaxAdd']);
   Route::get('/bill/{id1}/get/{id2}', [BillController::class, 'ajaxEdit']);
   //Roles Routes
   Route::resource('roles',RoleController::class);
   //Users Routes
   Route::resource('users',UserController::class);
   
  
});

Route::group(['middleware' => ['web','auth', 'tenancy.enforce']], function() {

//Subscritpion Routes
   Route::get('/plans', [SubscriptionController::class,'index'])->name('plans');
   Route::get('/plan/cancel', [SubscriptionController::class,'cancel'])->name('plan/cancel');
   Route::get('/plan/resume', [SubscriptionController::class,'resume'])->name('plan/resume');
   Route::get('/payments', [SubscriptionsPaymentController::class,'index'])->name('payments');
   Route::post('/payments', [SubscriptionsPaymentController::class,'store'])->name('payments.store');

});