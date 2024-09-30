<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Page;
use Illuminate\Http\Request;
use File;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Page::where('status', 1)->get();
        return view('backend.page.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.page.create', compact('type'));
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

        if($request->hasFile('thumbnail')) {                

            $originName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('thumbnail')->move(public_path('backend/page'), $fileName);
            $data['thumbnail']=$fileName;      
        }
       
        Page::create($data);

        return response()->json(['status'=>true ,'msg'=>'Page Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Page::find($id);        
        return view('backend.page.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Page::find($id);

        $data=$request->validate([
            'title'=> 'required',
            'description'=> 'required'            
       ]);       

        if($request->hasFile('thumbnail')) {

            $old_thumbnail_image = $item->thumbnail;           

            $originName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;        
            
            $request->file('thumbnail')->move(public_path('backend/page'), $fileName);
            $data['thumbnail']=$fileName;

            if($old_thumbnail_image){                
                if(File::exists(public_path().'/backend/page/'.$old_thumbnail_image))unlink(public_path().'/backend/page/'.$old_thumbnail_image);                
            }  

        }                       

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Page Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Page::find($id);      
        $item->delete();
        return response()->json(['status'=>true ,'msg'=>'Page Deleted !!']);
    }
}
