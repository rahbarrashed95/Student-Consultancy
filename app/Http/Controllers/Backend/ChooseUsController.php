<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\ChooseUs;
use Illuminate\Http\Request;

class ChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ChooseUs::where('status', 1)->get();
        return view('backend.choose.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ChooseUs $chooseUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=ChooseUs::find($id);        
        return view('backend.choose.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=ChooseUs::find($id);

        $data=$request->validate([
            'title'=> 'required',
            'description'=> 'required'            
       ]);

       if($request->hasFile('icon')) {     
        
           $old_icon_image = $item->icon;          

            $originName = $request->file('icon')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('icon')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('icon')->move(public_path('backend/choose'), $fileName);
            $data['icon']=$fileName;      

            if($old_icon_image){                
                if(File::exists(public_path().'/backend/choose/'.$old_icon_image))unlink(public_path().'/backend/choose/'.$old_icon_image);                
            } 

        }                             

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Choose Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChooseUs $chooseUs)
    {
        $item=Service::find($id);       

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Service Deleted !!']);
    }
}
