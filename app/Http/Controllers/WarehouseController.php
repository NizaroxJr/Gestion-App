<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $this->authorize('canWarehouse');
        $warehouses=Warehouse::all();
        return view('admin.warehouse.index',['warehouses'=> $warehouses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('canWarehouse');
         return view('admin.warehouse.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('canWarehouse');
        $this->authorize('canAddWarehouse');
        $warehouse=Warehouse::create($request->all());
        return redirect()->route('warehouse.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('canWarehouse');
        $warehouse=Warehouse::find($id); 
        return view('admin.warehouse.edit',compact('warehouse'));
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
        $this->authorize('canWarehouse');
        Warehouse::where('id', $id)->update(['name'=>$request->input('name'),
                                             'street1'=>$request->input('street1'),
                                             'street2'=>$request->input('street2'),
                                             'city'=>$request->input('city'),
                                             'country'=>$request->input('country'),
                                             'state'=>$request->input('state'),
                                             'phone'=>$request->input('phone'),
                                             'email'=>$request->input('email'),
                                             'zip'=>$request->input('zip')
                                          ]);
        return redirect()->route('warehouse.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('canWarehouse');
        Warehouse::where('id', $id)->delete();
        return redirect()->route('warehouse.index');
    }
}
