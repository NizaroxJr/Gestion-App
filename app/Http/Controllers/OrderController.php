<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;
use App\Models\Supplier;
use App\Models\OrderItem;
use PDF;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('canSales');
        $orders=Order::whereNull('supplier_id')->get();
        
        return view('admin.order.index',['orders'=> $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->authorize('canSales');
        $Saless=Sales::all();
        $clients=Client::all();
        $suppliers=Supplier::all();
        return view('admin.order.add',compact('clients','Saless','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('canSales');
        //Clone Sales
        if($request->input('id')){
            $cloneOrder=Order::find($request->input('id'));

            $order=Order::create([
                          'total'=>$cloneOrder->total,
                          'subtotal'=>$cloneOrder->subtotal,
                          'shipping'=>$cloneOrder->shipping,
                          'description'=>$cloneOrder->description,
                          'Status'=>$cloneOrder->Status,
                          'client_id'=>$cloneOrder->client_id,
                          'supplier_id'=>$cloneOrder->supplier_id,
                          'employee_id' =>$cloneOrder->employee_id,
                          'PaymentStatus' =>'Paid',
                                         ]); 
            
            foreach ($cloneOrder->orderItems as $item) {   
                OrderItem::Create(
                    [
                        'order_id' =>   $order->id,
                        'Sales_id' =>  $item->Sales_id,
                        'quantity' =>  $item->quantity,
                        'price' =>  $item->price,
                        'discount' => $item->discount,
                        'subtotal' =>  $item->subtotal,
                    ]
                ); 
            }

          
        }
        
        //Create Sales
        else{
           $employeeId = auth()->user()->id;

           $order=Order::create([
               'total'=>$request->input('total'),
               'subtotal'=>$request->input('finalSubtotal'),
               'shipping'=>$request->input('shipping'),
               'description'=>$request->input('description'),
               'Status'=>$request->input('status'),
               'client_id'=>$request->input('client'),
               'employee_id' =>  $employeeId,
               'PaymentStatus' =>   'Paid',

            ]);   
            
            foreach ($request->Sales as $key => $value) {   
                OrderItem::Create(
                    [
                        'order_id' =>   $order->id,
                        'Sales_id' =>  $request->Sales[$key],
                        'quantity' =>  $request->quantity[$key] ?? 1,
                        'price' =>  $request->price[$key] ?? 0,
                        'discount' => $request->discount[$key] ?? 0,
                        'subtotal' =>  $request->subtotal[$key] ?? 0,
                    ]
                ); 
            }
        }
        
        
        return redirect()->route('purchaseOrder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('canSales');
        $order=Order::find($id);
       return view('admin.order.show',
                   ['order'=>$order,
                   'items'=>$order->orderItems
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
        $this->authorize('canSales');
        $order=Order::find($id);
        $Saless=Sales::all();
        $clients=Client::all();

       return view('admin.purchaseOrder.edit',
                   ['order'=>$order,
                   'Saless'=>$Saless,
                    'clients'=>$clients,
                   'items'=>$order->orderItems
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
        $this->authorize('canSales');
       //Delete Order Items
       if(isset($request->destroy)){
            foreach ($request->destroy as $key => $value) { 
             OrderItem::where('id', $request->destroy[$key])->delete();
            }
         }

       Order::where('id', $id)->update(['client_id'=>$request->input('client'),
                                         'total'=>$request->input('total'),
                                         'subtotal'=>$request->input('finalSubtotal'),
                                         'shipping'=>$request->input('shipping'),
                                         'description'=>$request->input('description'),
                                         'Status'=>$request->input('status'),
                                        ]);

        if(isset($request->Sales)){
             foreach ($request->Sales as $key => $value) {   
                OrderItem::updateOrCreate(
                    ['id'=>$request->id[$key]],
                    [
                        'order_id' =>   $id,
                        'Sales_id' =>  $request->Sales[$key],
                        'quantity' =>  $request->quantity[$key] ?? 1,
                        'price' =>  $request->price[$key] ?? 0,
                        'discount' => $request->discount[$key] ?? 0,
                        'subtotal' =>  $request->subtotal[$key] ?? 0,
                    ]
                ); 
            }
        }

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
        $this->authorize('canSales');
        $order=Order::find($id);
        $order->delete();

        $orderItems=$order->orderItems;
        foreach ($orderItems as $item){ 
            OrderItem::where('id', $item->id)->delete();
         }
    
        return redirect()->route('purchaseOrder.index');
    }

     // this function opens the PDF in browser. If we want, we can downlod
    public function openPDF($id)
    {
        $this->authorize('canSales');
        $order = Order::find($id);
        $client=$order->client;
        $user=auth()->user();
        $items=$order->orderItems;
        // usersPdf is the view that includes the downloading content
        $view = \View::make('admin.order.print', ['order'=>$order,
                                                  'user'=>$user,
                                                  'client'=>$client,
                                                  'items'=>$items
                                                ]);
        $html_content = $view->render();
        // Set title in the PDF
        PDF::SetTitle("SO-00$order->id");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        // userlist is the name of the PDF downloading
        PDF::Output("SO-00$order->id.pdf");    
    }

    // this function directly downloads the PDF. 
    public function savePDF($id)
    {
        $this->authorize('canSales');
        $order = Order::find($id);
        $client=$order->client;
        $user=auth()->user();
        $items=$order->orderItems;
        // usersPdf is the view that includes the downloading content
        $view = \View::make('admin.order.print', ['order'=>$order,
                                                  'user'=>$user,
                                                  'client'=>$client,
                                                  'items'=>$items
                                                ]);
        $html_content = $view->render();
        PDF::SetTitle("SO-00$order->id");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        // D is the change of these two functions. Including D parameter will avoid 
        // loading PDF in browser and allows downloading directly
        PDF::Output("SO-00$order->id$order->id.pdf", 'D');   
    }

}
