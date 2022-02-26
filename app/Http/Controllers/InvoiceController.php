<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Order;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('canInvoice');
        $invoices=Invoice::all();
        return view('admin.invoice.index',['invoices'=> $invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('canInvoice');
        $orders=Order::whereNull('supplier_id')->get();
        return view('admin.invoice.add',compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('canInvoice');
        //Clone Product
        if($request->input('id')){
            $cloneinvoice=Invoice::find($request->input('id'));

            $invoice=Invoice::create([
                          'order_id'=>$cloneinvoice->id,
                          'description'=>$cloneinvoice->description,
                          'Status'=>$cloneinvoice->Status,
                          'Date'=>$cloneinvoice->Date,
                          'dueDate'=>$cloneinvoice->dueDate,
                          'PaymentStatus' =>'Paid',
                                         ]);   
        }
        
        //Create Product
        else{

           $invoice=Invoice::create([
               'order_id'=>$request->input('orderID'),
               'description'=>$request->input('description'),
               'Status'=>$request->input('status'),
               'Date'=>$request->input('date'),
               'dueDate'=>$request->input('dueDate'),
               'PaymentStatus'=>'Paid',
            ]);   
        }
        
        
        return redirect()->route('invoice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('canInvoice');
        $invoice=Invoice::find($id);
       return view('admin.invoice.show',
                   [
                   'invoice'=>$invoice
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
        $this->authorize('canInvoice');
       $invoice=Invoice::find($id);
       $orders=Order::whereNull('supplier_id')->get();
       return view('admin.invoice.edit',
                   ['invoice'=>$invoice,
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
        $this->authorize('canInvoice');
        Invoice::where('id', $id)->update(['order_id'=>$request->input('orderID'),
                                           'description'=>$request->input('description'),
                                           'Status'=>$request->input('status'),
                                           'Date'=>$request->input('date'),
                                           'dueDate'=>$request->input('dueDate'),
                                           'PaymentStatus'=>'Paid',
                                          ]);

        return redirect()->route('invoice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('canInvoice');
        Invoice::where('id',$id)->delete();
        return redirect()->route('invoice.index');
    }
    
     public function openPDF($id)
    {
        $invoice = Invoice::find($id);
        $client=$invoice->order->client;
        $user=auth()->user();
        $items=$invoice->order->orderItems;
        // usersPdf is the view that includes the downloading content
        $view = \View::make('admin.invoice.print', ['invoice'=>$invoice,
                                                  'user'=>$user,
                                                  'client'=>$client,
                                                  'items'=>$items,
                                                ]);
        $html_content = $view->render();
        // Set title in the PDF
        PDF::SetTitle("INV-00$invoice->id");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        // userlist is the name of the PDF downloading
        PDF::Output("INV-00$invoice->id.pdf");    
    }

    // this function directly downloads the PDF. 
    public function savePDF($id)
    {
        $invoice = Invoice::find($id);
        $client=$invoice->order->client;
        $user=auth()->user();
        $items=$invoice->order->orderItems;
        // usersPdf is the view that includes the downloading content
        $view = \View::make('admin.invoice.print', ['invoice'=>$invoice,
                                                  'user'=>$user,
                                                  'client'=>$client,
                                                  'items'=>$items,
                                                ]);
        $html_content = $view->render();
        // Set title in the PDF
        PDF::SetTitle("INV-00$invoice->id");
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        // userlist is the name of the PDF downloading
        PDF::Output("INV-00$invoice->id.pdf","D");   
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
