<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CountryVisa;
use Illuminate\Http\Request;
use File;

class CountryVisaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CountryVisa::where('status', 1)->latest()->get();        
        return view('backend.visa_immigration.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.visa_immigration.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'country'=> '',
            'title'=> '',
            'bottom_title'=> '',
            'country'=> '',            
            'description'=> ''            
       ]);

       if($request->hasFile('flag')) {
           $originName = $request->file('flag')->getClientOriginalName();
           $fileName = pathinfo($originName, PATHINFO_FILENAME);
           $extension = $request->file('flag')->getClientOriginalExtension();
           $fileName =$fileName.time().'.'.$extension;
       
           $request->file('flag')->move(public_path('backend/flag'), $fileName);
           $data['flag']=$fileName;
       }   

       if($request->hasFile('small_flag')) {
           $originName = $request->file('small_flag')->getClientOriginalName();
           $fileName = pathinfo($originName, PATHINFO_FILENAME);
           $extension = $request->file('small_flag')->getClientOriginalExtension();
           $fileName =$fileName.time().'.'.$extension;
       
           $request->file('small_flag')->move(public_path('backend/flag'), $fileName);
           $data['small_flag']=$fileName;
       }   

       CountryVisa::create($data);

       return response()->json(['status'=>true ,'msg'=>'Visa Immigration Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(CountryVisa $countryVisa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=CountryVisa::find($id);        
        return view('backend.visa_immigration.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=CountryVisa::find($id);

        $data=$request->validate([
            'country'=> '',
            'title'=> '',
            'bottom_title'=> '',
            'country'=> '',            
            'description'=> ''            
       ]);         
        
        if($request->hasFile('flag')) {
            $old_flag_image = $item->flag;    
            $originName = $request->file('flag')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('flag')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('flag')->move(public_path('backend/flag'), $fileName);
            $data['flag']=$fileName;

            if($old_flag_image){                
                if(File::exists(public_path().'/backend/flag/'.$old_flag_image))unlink(public_path().'/backend/flag/'.$old_flag_image);                
            }  
        }    
        
        if($request->hasFile('small_flag')) {
            $old_small_flag_image = $item->small_flag;    
            $originName = $request->file('small_flag')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('small_flag')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('small_flag')->move(public_path('backend/flag'), $fileName);
            $data['small_flag']=$fileName;

            if($old_small_flag_image){                
                if(File::exists(public_path().'/backend/flag/'.$old_small_flag_image))unlink(public_path().'/backend/flag/'.$old_small_flag_image);                
            }  
        }   

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Visa Immigration Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CountryVisa $countryVisa)
    {
        //
    }
}
