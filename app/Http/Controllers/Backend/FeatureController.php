<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Feature::latest()->get();
        return view('backend.feature.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.feature.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'feature_title'=> 'required',
            'feature_description'=> 'required'            
       ]); 

        Feature::create($data);

       return response()->json(['status'=>true ,'msg'=>'Feature Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Feature::find($id);        
        return view('backend.feature.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Feature::find($id);

        $data=$request->validate([            
            'feature_title'=> 'required',
            'feature_description'=> 'required'             
        ]); 
       
       $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Feature Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Feature::find($id);       

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Feature Deleted !!']);
    }
}
