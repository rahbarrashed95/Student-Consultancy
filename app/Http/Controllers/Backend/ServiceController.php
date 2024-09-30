<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Service;
use Illuminate\Http\Request;

use File;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Service::where('status', 1)->get();
        return view('backend.service.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.service.create', compact('type'));
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
            
            $request->file('header_image')->move(public_path('backend/service'), $fileName);
            $data['header_image']=$fileName;      
        }

        if($request->hasFile('thumbnail')) {                

            $originName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('thumbnail')->move(public_path('backend/service'), $fileName);
            $data['thumbnail']=$fileName;      
        }

        if($request->hasFile('icon')) {                

            $originName = $request->file('icon')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('icon')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('icon')->move(public_path('backend/service'), $fileName);
            $data['icon']=$fileName;      
        }

        Service::create($data);

        return response()->json(['status'=>true ,'msg'=>'Service Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Service::find($id);        
        return view('backend.service.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Service::find($id);

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
            
            $request->file('header_image')->move(public_path('backend/service'), $fileName);
            $data['header_image']=$fileName;      

            if($old_header_image){                
                if(File::exists(public_path().'/backend/service/'.$old_header_image))unlink(public_path().'/backend/service/'.$old_header_image);                
            } 

        }

        if($request->hasFile('thumbnail')) {

            $old_thumbnail_image = $item->thumbnail;           

            $originName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('thumbnail')->move(public_path('backend/service'), $fileName);
            $data['thumbnail']=$fileName;

            if($old_thumbnail_image){                
                if(File::exists(public_path().'/backend/service/'.$old_thumbnail_image))unlink(public_path().'/backend/service/'.$old_thumbnail_image);                
            }  

        }    

        if($request->hasFile('icon')) {

            $old_icon_image = $item->icon;           

            $originName = $request->file('icon')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('icon')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('icon')->move(public_path('backend/service'), $fileName);
            $data['icon']=$fileName;

            if($old_icon_image){                
                if(File::exists(public_path().'/backend/service/'.$old_icon_image))unlink(public_path().'/backend/service/'.$old_icon_image);                
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
        $item=Service::find($id);       

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Service Deleted !!']);
    }
}
