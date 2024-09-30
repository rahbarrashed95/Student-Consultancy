<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Testimonial;
use Illuminate\Http\Request;

use File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Testimonial::where('status', 1)->get();
        return view('backend.testimonial.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.testimonial.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=> '',
            'designation'=> '',
            'description'=> ''            
        ]); 

        if($request->hasFile('image')) {                

            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('image')->move(public_path('backend/testimonial'), $fileName);
            $data['image']=$fileName;      
        }            

        Testimonial::create($data);

        return response()->json(['status'=>true ,'msg'=>'Testimonial Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Testimonial::find($id);        
        return view('backend.testimonial.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Testimonial::find($id);

        $data=$request->validate([
            'name'=> '',
            'designation'=> '',
            'description'=> ''            
        ]); 

        if($request->hasFile('image')) {       
            
            $old_image = $item->image;   

            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('image')->move(public_path('backend/testimonial'), $fileName);
            $data['image']=$fileName; 
            
            if($old_image){                
                if(File::exists(public_path().'/backend/testimonial/'.$old_image))unlink(public_path().'/backend/testimonial/'.$old_image);                
            } 
            
        }                        

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Testimonial Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Testimonial::find($id);       

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Testimonial Deleted !!']);
    }
}
