<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeType;

class EmployeeTypeController extends Controller
{
    public function index(){   

        $items=EmployeeType::latest()->get();
        return view('backend.employee_types.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.employee_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
             'name'=> 'required',
        ]);
        EmployeeType::create($data);

        return response()->json(['status'=>true ,'msg'=>'EmployeeType Created !!']);

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
        $item=EmployeeType::find($id);
        return view('backend.employee_types.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=EmployeeType::find($id);
        $data=$request->validate([
             'name'=> 'required',
        ]);

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'EmployeeType Updated !!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $item=EmployeeType::find($id);        
        $item->delete();


        return response()->json(['status'=>true ,'msg'=>'EmployeeType Deleted !!']);

    }

}
