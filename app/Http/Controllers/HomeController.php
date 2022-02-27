<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Bill;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $host = request()->getHttpHost();
        $orders = Order::all()->count();
        $salesOrders = Order::whereNull('supplier_id')->get()->count();
        $purchaseOrders = Order::whereNull('client_id')->get()->count();
        $paidBills = Bill::where('Status','=','Paid')->get()->count();
        $unpaidBills = Bill::where('Status','=','Pending')->get()->count();
        $notShippedBills = Order::where('Status','=','Not Shipped')->get()->count();
        $users = User::all()->count();
        $suppliers = Supplier::all()->count();
        $products = Product::all()->count();
        $warehouses = Warehouse::all()->count();
        
        return view('tenants.admin',compact('users','suppliers','products','warehouses','orders','salesOrders','purchaseOrders','paidBills','unpaidBills','notShippedBills'));
    }
}
