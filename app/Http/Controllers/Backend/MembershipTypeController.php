<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipType;

class MembershipTypeController extends Controller
{
    public function index(){   

        $items=MembershipType::latest()->get();
        return view('backend.membership_types.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.membership_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
             'name'=> 'required',
             'amount'=> 'required',
             'duration'=> '',
        ]);

        MembershipType::create($data);

        return response()->json(['status'=>true ,'msg'=>'MembershipType Created !!']);

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
        $item=MembershipType::find($id);
        return view('backend.membership_types.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=MembershipType::find($id);
        $data=$request->validate([
             'name'=> 'required',
             'amount'=> 'required',
             'duration'=> '',
        ]);

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'MembershipType Updated !!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $item=MembershipType::find($id);        
        $item->delete();


        return response()->json(['status'=>true ,'msg'=>'MembershipType Deleted !!']);

    }
}
