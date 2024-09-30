<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {   $items=ProductCategory::latest()->get();
        return view('backend.product_categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.product_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
             'name'=> 'required',
             'image'=> '',
        ]);

        if($request->hasFile('image')) {
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('product_categories'), $fileName);
            $data['image']=$fileName;
        }


        ProductCategory::create($data);

        return response()->json(['status'=>true ,'msg'=>'ProductCategory Created !!']);

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
        $item=ProductCategory::find($id);
        return view('backend.product_categories.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=ProductCategory::find($id);
        $data=$request->validate([
             'name'=> 'required',
             'image'=> '',
        ]);


        if($request->hasFile('image')) {

            deleteImage('product_categories',$item->image);

            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('product_categories'), $fileName);
            $data['image']=$fileName;
        }

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'ProductCategory Updated !!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=ProductCategory::find($id);
        
        deleteImage('product_categories',$item->image);
        $item->delete();
        
        return response()->json(['status'=>true ,'msg'=>'ProductCategory Deleted !!']);

    }


}
