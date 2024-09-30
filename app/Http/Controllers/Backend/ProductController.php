<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Product;
Use App\Models\ProductCategory;


class ProductController extends Controller
{
    public function index()
    {   $items=Product::latest()->get();
        return view('backend.products.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats=ProductCategory::latest()->get();

        return view('backend.products.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
             'name'=> 'required',
             'sku'=> 'required|unique:products,sku',
             'category_id'=> 'required',
             'image'=> '',
             'purchase_price'=> '',
             'sell_price'=> '',
             'description'=> '',
        ]);
         
        if($request->hasFile('image')) {
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('products'), $fileName);
            $data['image']=$fileName;
        }


        Product::create($data);

        return response()->json(['status'=>true ,'msg'=>'Product Created !!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Product::find($id);
        $cats=ProductCategory::latest()->get();
        return view('backend.products.edit', compact('item','cats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Product::find($id);
        $data=$request->validate([
             'name'=> 'required',
             'sku'=> 'required|unique:products,sku,'.$id,

             'category_id'=> 'required',
             'image'=> '',
             'description'=> '',
             'purchase_price'=> '',
             'sell_price'=> '',
        ]);

        if($request->hasFile('image')) {

            deleteImage('products',$item->image);

            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('products'), $fileName);
            $data['image']=$fileName;
        }

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Product Updated !!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $item=Product::find($id);
        
        deleteImage('products',$item->image);
        $item->delete();


        return response()->json(['status'=>true ,'msg'=>'Product Deleted !!']);
    }


}
