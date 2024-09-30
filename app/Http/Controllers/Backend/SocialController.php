<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Social::where('status', 1)->latest()->get();
        return view('backend.social.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.social.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'icon'=> 'required',
            'link'=> ''         
       ]); 

        Social::create($data);

       return response()->json(['status'=>true ,'msg'=>'Social Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {      
        $item=Social::find($id);        
        return view('backend.social.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Social::find($id);

        $data=$request->validate([
            'icon'=> 'required',
            'link'=> ''         
       ]);
       
       $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Social Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Social::find($id);       

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Social Deleted !!']);
    
    }
}
