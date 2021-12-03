<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::all();
        return view('admin.order.index',['orders'=> $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $products=Product::all();
        $clients=Client::all();
        return view('admin.order.add',compact('clients','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Clone Product
        if($request->input('id')){
            $cloneProduct=Product::find($request->input('id'));

            Product::create([
            'name'=>$cloneProduct->name."(Copy)",
            'price'=>$cloneProduct->price,
            'quantity'=>$cloneProduct->quantity,
            'description'=>$cloneProduct->description,
            'status'=>$cloneProduct->status,
            'tags'=>$cloneProduct->tags,
             'img'=>$cloneProduct->img,
             'supplier_id'=>$cloneProduct->supplier_id,
             'category_id'=>$cloneProduct->category_id
                           ]);
          
        }
        
        //Create Product
        else{

           $order=Order::create([
               'price'=>$request->input('price'),
               'quantity'=>$request->input('quantity'),
               'description'=>$request->input('description'),
               'Status'=>$request->input('status'),
               'product_id'=>$request->input('product'),
               'client_id'=>$request->input('client')
             ]);        
        }

        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);

       return view('admin.order.show',
                   ['order'=>$order,
                   'client'=>$order->client,
                   'product'=>$order->product
                   ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::find($id);
        $clients=Client::all();
        $products=Product::all();
        
        
        return view('admin.order.edit',
                   ['order'=>$order,
                   'clients'=>$clients,
                   'products'=>$products
                   ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Order::where('id', $id)->update(['client_id'=>$request->input('client'),
                                          'product_id'=>$request->input('product'),
                                          'quantity'=>$request->input('quantity'),
                                          'description'=>$request->input('description'),
                                          'Status'=>$request->input('status'),
                                          'price'=>$request->input('price'),
                                        ]);

         return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::where('id', $id)->delete();
        return redirect()->route('order.index');
    }
}
