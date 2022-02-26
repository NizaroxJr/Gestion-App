<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Supplier;
use App\Models\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('canProduct');
        $products=Product::all();

        return view('admin.products.index',['products'=> $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('canProduct');
        $suppliers=Supplier::all();
        $categories=Category::all();

        return view('admin.products.add',compact('suppliers','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('canProduct');
        $this->authorize('canAddProduct');
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
           //Persist Image To DB
           $input = $request->all();
   
           if($file = $request->file('img')){
               $name=$file->getClientOriginalName();
               $file->move('images',$name);
               $input['img']=$name;
           }
           
           
           $product=Product::create([
               'name'=>$request->input('name'),
               'price'=>$request->input('price'),
               'quantity'=>$request->input('quantity'),
               'description'=>$request->input('description'),
               'status'=>$request->input('status'),
               'supplier'=>$request->input('supplier'),
               'tags'=>$request->input('tags'),
                'img'=>$input['img'],
                'supplier_id'=>$request->input('supplier'),
                'category_id'=>$request->input('category')
             ]);        
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('canProduct');
        $product=Product::find($id);

       return view('admin.products.show',
                   ['product'=>$product,
                   'supplier'=>$product->supplier,
                   'category'=>$product->category
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
        $this->authorize('canProduct');
        $product=Product::find($id);
        $suppliers=Supplier::all();
        $categories=Category::all();
        
        
        return view('admin.products.edit',
                   ['product'=>$product,
                   'suppliers'=>$suppliers,
                   'categories'=>$categories
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
        $this->authorize('canProduct');
        //Persist Image To DB
        $input = $request->all();

        if($file = $request->file('img')){
            $name=$file->getClientOriginalName();
            $file->move('images',$name);
            $input['img']=$name;
        }

         
        Product::where('id', $id)->update(['name'=>$request->input('name'),
                                          'price'=>$request->input('price'),
                                          'quantity'=>$request->input('quantity'),
                                          'description'=>$request->input('description'),
                                          'status'=>$request->input('status'),
                                          'tags'=>$request->input('tags'),
                                           'img'=>$input['img'],
                                           'supplier_id'=>$request->input('supplier'),
                                           'category_id'=>$request->input('category')
                                        ]);

         return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('canProduct');
        Product::where('id', $id)->delete();
        return redirect()->route('products.index');
    }
}
