<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use File;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = AboutUs::where('status', 1)->get();
        return view('backend.about.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.about.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'title'=> 'required',
            'description'=> 'required'            
        ]); 

        if($request->hasFile('header_image')) {                

            $originName = $request->file('header_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('header_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('header_image')->move(public_path('backend/about'), $fileName);
            $data['header_image']=$fileName;      
        }

        if($request->hasFile('thumbnail')) {                

            $originName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('thumbnail')->move(public_path('backend/about'), $fileName);
            $data['thumbnail']=$fileName;      
        }        

        AboutUs::create($data);

        return response()->json(['status'=>true ,'msg'=>'About Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=AboutUs::find($id);        
        return view('backend.about.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=AboutUs::find($id);

        $data=$request->validate([
            'title'=> 'required',
            'description'=> 'required'            
       ]);

       if($request->hasFile('header_image')) {     
        
           $old_header_image = $item->header_image;          

            $originName = $request->file('header_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('header_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('header_image')->move(public_path('backend/about'), $fileName);
            $data['header_image']=$fileName;      

            if($old_header_image){                
                if(File::exists(public_path().'/backend/about/'.$old_header_image))unlink(public_path().'/backend/about/'.$old_header_image);                
            } 

        }

        if($request->hasFile('thumbnail')) {

            $old_thumbnail_image = $item->thumbnail;           

            $originName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('thumbnail')->move(public_path('backend/about'), $fileName);
            $data['thumbnail']=$fileName;

            if($old_thumbnail_image){                
                if(File::exists(public_path().'/backend/about/'.$old_thumbnail_image))unlink(public_path().'/backend/about/'.$old_thumbnail_image);                
            }  

        }                       

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Slider Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        $item=Service::find($id);       

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Service Deleted !!']);
    }
}
