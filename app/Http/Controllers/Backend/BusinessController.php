<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        if(!auth()->user()->can('settings.view'))
        {
            abort(403, 'unauthorized');
        }
        $item=Business::first();
        return view('backend.settings.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('settings.create'))
        {
            abort(403, 'unauthorized');
        }

        $data=$request->validate([
             'name'=> 'required',
             'logo'=> 'nullable|image',
             'email'=> '',
             'contact'=> '',
             'alternative_conatct'=> '',
             'note'=> '',
             'address'=> '',
        ]);

        if($request->hasFile('logo')) {
            $originName = $request->file('logo')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('logo')->move(public_path('settings'), $fileName);
            $data['logo']=$fileName;
        }

        $item=Business::first();
        if ($item) {
            $item->update($data);
        }else{
            Business::create($data);

        }
        \Cache::forget('info');

        return response()->json(['status'=>true ,'msg'=>'Settings  Updated !!']);

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
