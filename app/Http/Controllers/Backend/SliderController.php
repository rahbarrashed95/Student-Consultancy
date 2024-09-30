<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;

use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Slider::where('status', 1)->latest()->get();
        return view('backend.sliders.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.sliders.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'sub_title'=> 'required',
            'title'=> '',
            'description'=> ''            
       ]);

       if($request->hasFile('slider_image')) {
           $originName = $request->file('slider_image')->getClientOriginalName();
           $fileName = pathinfo($originName, PATHINFO_FILENAME);
           $extension = $request->file('slider_image')->getClientOriginalExtension();
           $fileName =$fileName.time().'.'.$extension;
       
           $request->file('slider_image')->move(public_path('backend/sliders'), $fileName);
           $data['slider_image']=$fileName;
       }

       if($request->hasFile('human_image')) {
           $originName = $request->file('human_image')->getClientOriginalName();
           $fileName = pathinfo($originName, PATHINFO_FILENAME);
           $extension = $request->file('human_image')->getClientOriginalExtension();
           $fileName =$fileName.time().'.'.$extension;
       
           $request->file('human_image')->move(public_path('backend/sliders'), $fileName);
           $data['human_image']=$fileName;
       }

       if($request->hasFile('layer1_image')) {
           $originName = $request->file('layer1_image')->getClientOriginalName();
           $fileName = pathinfo($originName, PATHINFO_FILENAME);
           $extension = $request->file('layer1_image')->getClientOriginalExtension();
           $fileName =$fileName.time().'.'.$extension;
       
           $request->file('layer1_image')->move(public_path('backend/sliders'), $fileName);
           $data['layer1_image']=$fileName;
       }

       if($request->hasFile('layer2_image')) {
           $originName = $request->file('layer2_image')->getClientOriginalName();
           $fileName = pathinfo($originName, PATHINFO_FILENAME);
           $extension = $request->file('layer2_image')->getClientOriginalExtension();
           $fileName =$fileName.time().'.'.$extension;
       
           $request->file('layer2_image')->move(public_path('backend/sliders'), $fileName);
           $data['layer2_image']=$fileName;
       }

       if($request->hasFile('layer3_image')) {
           $originName = $request->file('layer3_image')->getClientOriginalName();
           $fileName = pathinfo($originName, PATHINFO_FILENAME);
           $extension = $request->file('layer3_image')->getClientOriginalExtension();
           $fileName =$fileName.time().'.'.$extension;
       
           $request->file('layer3_image')->move(public_path('backend/sliders'), $fileName);
           $data['layer3_image']=$fileName;
       }


       Slider::create($data);

       return response()->json(['status'=>true ,'msg'=>'Customer Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Slider::find($id);        
        return view('backend.sliders.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Slider::find($id);

        $data=$request->validate([
            'sub_title'=> 'required',
            'title'=> '',
            'description'=> ''            
        ]);

        if($request->hasFile('slider_image')) {

            $old_slider_image = $item->slider_image;           

            $originName = $request->file('slider_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('slider_image')->move(public_path('backend/sliders'), $fileName);
            $data['slider_image']=$fileName;

            if($old_slider_image){                
                if(File::exists(public_path().'/backend/sliders/'.$old_slider_image))unlink(public_path().'/backend/sliders/'.$old_slider_image);                
            }  

        }

        if($request->hasFile('human_image')) {

            $old_human_image = $item->human_image;

            $originName = $request->file('human_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('human_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
           
            $request->file('human_image')->move(public_path('backend/sliders'), $fileName);
            $data['human_image']=$fileName;

            if($old_human_image){
                if(File::exists(public_path().'/backend/sliders/'.$old_human_image))unlink(public_path().'/backend/sliders/'.$old_human_image);                
            } 

        }
        if($request->hasFile('layer1_image')) {

            $old_layer1_image = $item->layer1_image;

            $originName = $request->file('layer1_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('layer1_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
           
            $request->file('layer1_image')->move(public_path('backend/sliders'), $fileName);
            $data['layer1_image']=$fileName;

            if($old_layer1_image){
                if(File::exists(public_path().'/backend/sliders/'.$old_layer1_image))unlink(public_path().'/backend/sliders/'.$old_layer1_image);                
            } 
        }
        if($request->hasFile('layer2_image')) {

            $old_layer2_image = $item->layer2_image;

            $originName = $request->file('layer2_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('layer2_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('layer2_image')->move(public_path('backend/sliders'), $fileName);
            $data['layer2_image']=$fileName;

            if($old_layer2_image){
                if(File::exists(public_path().'/backend/sliders/'.$old_layer2_image))unlink(public_path().'/backend/sliders/'.$old_layer2_image);                
            } 
            
        }
        if($request->hasFile('layer3_image')) {

            $old_layer3_image = $item->layer3_image;

            $originName = $request->file('layer3_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('layer3_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('layer3_image')->move(public_path('backend/sliders'), $fileName);
            $data['layer3_image']=$fileName;

            if($old_layer3_image){
                if(File::exists(public_path().'/backend/sliders/'.$old_layer3_image))unlink(public_path().'/backend/sliders/'.$old_layer3_image);                
            } 

        }

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Slider Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Slider::find($id);

        $old_slider_image = $item->slider_image;
        $old_human_image = $item->human_image;
        $old_human_image = $item->human_image;
        $old_layer1_image = $item->layer1_image;
        $old_layer2_image = $item->layer2_image;
        $old_layer3_image = $item->layer3_image;
        
        if($old_slider_image){                
            if(File::exists(public_path().'/backend/sliders/'.$old_slider_image))unlink(public_path().'/backend/sliders/'.$old_slider_image);                
        }        


        if($old_human_image){
            if(File::exists(public_path().'/backend/sliders/'.$old_human_image))unlink(public_path().'/backend/sliders/'.$old_human_image);                
        } 

        if($old_layer1_image){
            if(File::exists(public_path().'/backend/sliders/'.$old_layer1_image))unlink(public_path().'/backend/sliders/'.$old_layer1_image);                
        } 

        if($old_layer2_image){
            if(File::exists(public_path().'/backend/sliders/'.$old_layer2_image))unlink(public_path().'/backend/sliders/'.$old_layer2_image);                
        } 

        if($old_layer3_image){
            if(File::exists(public_path().'/backend/sliders/'.$old_layer3_image))unlink(public_path().'/backend/sliders/'.$old_layer3_image);                
        } 

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Slider Deleted !!']);
    }
}
