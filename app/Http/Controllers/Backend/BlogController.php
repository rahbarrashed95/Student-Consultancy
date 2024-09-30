<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use Illuminate\Http\Request;

use File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Blog::where('status', 1)->get();
        return view('backend.blog.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.blog.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'title'=> '',
            'description'=> ''           
        ]); 

        if($request->hasFile('thumbnail')) {                

            $originName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('thumbnail')->move(public_path('backend/blog'), $fileName);
            $data['thumbnail']=$fileName;      
        }            

        Blog::create($data);

        return response()->json(['status'=>true ,'msg'=>'Blog Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Blog::find($id);        
        return view('backend.blog.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Blog::find($id);

        $data=$request->validate([
            'title'=> '',           
            'description'=> ''            
        ]); 

        if($request->hasFile('thumbnail')) {       
            
            $old_image = $item->thumbnail;   

            $originName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('thumbnail')->move(public_path('backend/blog'), $fileName);
            $data['thumbnail']=$fileName; 
            
            if($old_image){                
                if(File::exists(public_path().'/backend/blog/'.$old_image))unlink(public_path().'/backend/blog/'.$old_image);                
            } 
            
        }                        

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Blog Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Blog::find($id);      

        $old_thumbnail = $item->thumbnail;

        $item->delete();

        if($old_thumbnail){                
            if(File::exists(public_path().'/backend/blog/'.$old_thumbnail))unlink(public_path().'/backend/blog/'.$old_thumbnail);                
        } 

        return response()->json(['status'=>true ,'msg'=>'Blog Deleted !!']);
    }
}
