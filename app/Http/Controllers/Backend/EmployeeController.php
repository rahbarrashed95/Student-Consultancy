<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Employee;
Use App\Models\EmployeeType;
Use App\Models\TransactionPayment;

class EmployeeController extends Controller
{
    public function index(){   
        $items=Employee::get();
        return view('backend.employees.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types=EmployeeType::get();
        return view('backend.employees.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $data=$request->validate([
             'name'=> 'required',
             'email'=> '',
             'image'=> '',
             'address'=> '',
             'phone'=> 'required',
             'salary'=> '',
             'employee_type_id'=> 'required',
             'info'=> '',
        ]);

        if($request->hasFile('image')) {
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('employees'), $fileName);
            $data['image']=$fileName;
        }


        Employee::create($data);

        return response()->json(['status'=>true ,'msg'=>'Employee Created !!']);

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
        $item=Employee::find($id);
        $types=EmployeeType::get();
        return view('backend.employees.edit', compact('item','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Employee::find($id);
        $data=$request->validate([
             'name'=> 'required',
             'email'=> '',
             'address'=> '',
             'phone'=> 'required',
             'salary'=> '',
             'employee_type_id'=> 'required',
             'info'=> '',
        ]);

        if($request->hasFile('image')) {

            deleteImage('employees',$item->image);

            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('employees'), $fileName);
            $data['image']=$fileName;
        }

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Employee Updated !!']);

    }

    public function destroy(string $id)
    {

        $item=Employee::find($id);
        
        deleteImage('employees',$item->image);
        $item->delete();


        return response()->json(['status'=>true ,'msg'=>'Employee Deleted !!']);

    }

    public function getEmployeePayment($id){
        $employee=Employee::find($id);
        return view('backend.employees.payment', compact('employee'));
    }

    public function storeEmployeePayment(Request $request, $id){

        $data=$request->validate([
             'amount'=> 'required',
             'method'=> 'required',
             'type'=> 'required',
             'date'=> 'required',
             'note'=> '',
        ]);
        $data['user_id']=auth()->user()->id;
        $data['employee_id']=$id;

        TransactionPayment::create($data);
        return response()->json(['status'=>true ,'msg'=>'Employee Payment Success !!']);

    }



}
