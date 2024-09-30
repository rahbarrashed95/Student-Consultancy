<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use Illuminate\Http\Request;

use File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Brand::where('status', 1)->get();
        return view('backend.brand.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.brand.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {       

        if($request->hasFile('logo')) {                

            $originName = $request->file('logo')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('logo')->move(public_path('backend/brand'), $fileName);
            $data['logo']=$fileName;      
        }            

        Brand::create($data);

        return response()->json(['status'=>true ,'msg'=>'Brand Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Brand::find($id);        
        return view('backend.brand.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Brand::find($id);        

        if($request->hasFile('logo')) {       
            
            $old_brand = $item->logo;   

            $originName = $request->file('logo')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('logo')->move(public_path('backend/brand'), $fileName);
            $data['logo']=$fileName; 
            
            if($old_brand){                
                if(File::exists(public_path().'/backend/brand/'.$old_brand))unlink(public_path().'/backend/brand/'.$old_brand);                
            } 
            
        }                        

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Brand Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Brand::find($id);       

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Brand Deleted !!']);
    }
}
