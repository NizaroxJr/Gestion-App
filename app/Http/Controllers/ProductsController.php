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

        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Persist Image To DB
        $input = $request->all();

        if($file = $request->file('img')){
            $name=$file->getClientOriginalName();
            $file->move('images',$name);
            $input['img']=$name;
        }
        
        //Find Supplier/category ID
        $supplier=Supplier::where('name','=',$request->input('supplier'));
        $category=Category::where('title','=',$request->input('category'));

        //Create New Product
        $product=Product::create([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'quantity'=>$request->input('quantity'),
            'description'=>$request->input('description'),
            'status'=>$request->input('status'),
            'supplier'=>$request->input('supplier'),
            'tags'=>$request->input('tags'),
             'img'=>$input['img'],
             'supplier_id'=>$supplier
          ]);
        //Find Inserted Product
        $product = $product->fresh();
        //$product=Product::find($product['id']);

        //Insert tag and product_tag 
        $tag = new Tag(['title'=> $request->input('tags')]);
        $product->tags()->save($tag);
        //Insert product_category
        $product->category()->save(['category_id'=>$category,'product_id'=>$product['id']]);

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
        $product=Product::find($id);
        return view('admin.products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
