<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{
    public function index(){   

        $items=ExpenseCategory::latest()->get();
        return view('backend.expense_categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.expense_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
             'name'=> 'required',
        ]);
        ExpenseCategory::create($data);

        return response()->json(['status'=>true ,'msg'=>'ExpenseCategory Created !!']);

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
        $item=ExpenseCategory::find($id);
        return view('backend.expense_categories.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=ExpenseCategory::find($id);
        $data=$request->validate([
             'name'=> 'required',
        ]);

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'ExpenseCategory Updated !!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $item=ExpenseCategory::find($id);        
        $item->delete();


        return response()->json(['status'=>true ,'msg'=>'ExpenseCategory Deleted !!']);

    }

    


}
