<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Faq::where('status', 1)->get();
        return view('backend.faq.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.faq.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'question'=> '',
            'answer'=> ''            
        ]);            

        Faq::create($data);

        return response()->json(['status'=>true ,'msg'=>'Faq Created !!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Faq::find($id);        
        return view('backend.faq.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Faq::find($id);

        $data=$request->validate([
            'question'=> '',
            'answer'=> ''            
        ]);                          

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Faq Updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item=Faq::find($id);       

        $item->delete();

        return response()->json(['status'=>true ,'msg'=>'Faq Deleted !!']);
    }
}
