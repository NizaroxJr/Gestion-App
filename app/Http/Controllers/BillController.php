<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Supplier;
use App\Models\Product;
use PDF;

class BillController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills=Bill::all();
        return view('admin.bill.index',['bills'=> $bills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orders=Order::whereNull('client_id')->get();
        return view('admin.bill.add',compact('orders'));
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
            $clonebill=bill::find($request->input('id'));

            $bill=bill::create([
                          'order_id'=>$clonebill->id,
                          'description'=>$clonebill->description,
                          'Status'=>$clonebill->Status,
                          'Date'=>$clonebill->Date,
                          'dueDate'=>$clonebill->dueDate,
                          'PaymentStatus' =>'Paid',
                                         ]);   
        }
        
        //Create Product
        else{

           $bill=bill::create([
               'order_id'=>$request->input('orderID'),
               'description'=>$request->input('description'),
               'Status'=>$request->input('status'),
               'Date'=>$request->input('date'),
               'dueDate'=>$request->input('dueDate'),
               'PaymentStatus'=>'Paid',
            ]);   
        }
        
        
        return redirect()->route('bill.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $bill=bill::find($id);
       return view('admin.bill.show',
                   [
                   'bill'=>$bill
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
       $bill=bill::find($id);
       $orders=Order::whereNull('client_id')->get();
       return view('admin.bill.edit',
                   ['bill'=>$bill,
                    'orders'=>$orders
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
        bill::where('id', $id)->update(['order_id'=>$request->input('orderID'),
                                           'description'=>$request->input('description'),
                                           'Status'=>$request->input('status'),
                                           'Date'=>$request->input('date'),
                                           'dueDate'=>$request->input('dueDate'),
                                           'PaymentStatus'=>'Paid',
                                          ]);

        return redirect()->route('bill.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        bill::where('id',$id)->delete();
        return redirect()->route('bill.index');
    }
    
     public function openPDF($id)
    {
        $bill = bill::find($id);
        $supplier=$bill->order->supplier;
        $user=auth()->user();
        $items=$bill->order->orderItems;
        // usersPdf is the view that includes the downloading content
        $view = \View::make('admin.bill.print', ['bill'=>$bill,
                                                  'user'=>$user,
                                                  'supplier'=>$supplier,
                                                  'items'=>$items,
                                                ]);
        $html_content = $view->render();
        // Set title in the PDF
        PDF::SetTitle("INV-00$bill->id");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        // userlist is the name of the PDF downloading
        PDF::Output("INV-00$bill->id.pdf");    
    }

    // this function directly downloads the PDF. 
    public function savePDF($id)
    {
        $bill = bill::find($id);
        $supplier=$bill->order->supplier;
        $user=auth()->user();
        $items=$bill->order->orderItems;
        // usersPdf is the view that includes the downloading content
        $view = \View::make('admin.bill.print', ['bill'=>$bill,
                                                  'user'=>$user,
                                                  'supplier'=>$supplier,
                                                  'items'=>$items,
                                                ]);
        $html_content = $view->render();
        // Set title in the PDF
        PDF::SetTitle("INV-00$bill->id");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        // userlist is the name of the PDF downloading
        PDF::Output("INV-00$bill->id.pdf","D");   
    }

    public function ajaxAdd($id)
    {
        $order=Order::find($id);
        $orderItems=$order->orderItems;
        $itemProduct=[];
        
        foreach($orderItems as $item){
            array_push($itemProduct,$item->product->name);
        }
        return ['order'=>$order,
                'orderItems'=>$orderItems,
                 'itemProduct'=>$itemProduct
            ];
    }

    public function ajaxEdit($id1,$id2){
        $order=Order::find($id2);
        $orderItems=$order->orderItems;
        $itemProduct=[];
        
        foreach($orderItems as $item){
            array_push($itemProduct,$item->product->name);
        }
        return ['order'=>$order,
                'orderItems'=>$orderItems,
                 'itemProduct'=>$itemProduct
            ];
    }
}
