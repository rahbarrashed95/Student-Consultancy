<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction; 
use App\Models\TransactionPayment; 
use App\Models\ExpenseCategory; 
use Illuminate\Support\Facades\DB; 

class TransactionController extends Controller
{
    public function index()
    {
        if(!auth()->user()->can('expenses.view'))
        {
            abort('403', 'Unauthorized');
        }

        $items=Transaction::whereIn('type',['expense','income'])->latest()->paginate(30);
        return view('backend.transactions.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->can('expenses.create'))
        {
            abort('403', 'Unauthorized');
        }

        $cats=ExpenseCategory::get();
        return view('backend.transactions.create', compact('cats'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('expenses.create'))
        {
            abort('403', 'Unauthorized');
        }

        $data=$request->validate([
             'note'=> '',
             'date'=> 'required',
             'type'=> 'required',
             'expense_category_id'=> 'required',
             'amount'=> 'required|numeric',
             'invoice_no'=> '',
        ]);
        $data['user_id']=auth()->user()->id;

        if(empty($request->invoice_no))
        {
            $data['invoice_no'] = rand(111111,999999);
        }

        DB::beginTransaction();

        try {
            $data['date']=newdate($data['date']);
            $purchase=Transaction::create($data);

            if (!empty(request('pay_amount'))) {
                
                $pay=[
                    'transaction_id'=>$purchase->id,
                    'amount'=>$request->pay_amount,
                    'method'=>$request->method,
                    'note'=>$request->pay_note,
                    'type'=>$purchase->type,
                ];
                TransactionPayment::create($pay);
            }

            transactionStatus($purchase);


            DB::commit();
            return response()->json(['status'=>true ,'msg'=>'Successfully Created !!','url'=> route('admin.transactions.index')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>false ,'msg'=>$e->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('backend.purchase.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('expenses.edit'))
        {
            abort('403', 'Unauthorized');
        }

        $item=Transaction::find($id);
        $cats=ExpenseCategory::all();
        return view('backend.transactions.edit', compact('item','cats'));
        
    }


    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('expenses.edit'))
        {
            abort('403', 'Unauthorized');
        }

        $purchase=Transaction::find($id);
        $data=$request->validate([
             'note'=> '',
             'date'=> 'required',
             'type'=> 'required',
             'expense_category_id'=> 'required',
             'amount'=> 'required|numeric',
             'invoice_no'=> '',
        ]);


         DB::beginTransaction();

        try {


            $data['date']=newdate($data['date']);


            $purchase->update($data);

            if(isset($request->pay_amount)){

                foreach ($request->pay_amount as $key => $amount) {
                    if(isset($request->pay_id[$key])){
                        $pay=TransactionPayment::find($request->pay_id[$key]);
                    }else{
                        $pay=new TransactionPayment();
                    }
                    
                    $pay->transaction_id=$purchase->id;
                    $pay->method=$request->method[$key];
                    $pay->amount=$amount;
                    $pay->note=$request->pay_note[$key];
                    $pay->type=$purchase->type;
                    $pay->save();

                }
            }

            transactionStatus($purchase);

            DB::commit();
            return response()->json(['status'=>true ,'msg'=>'Successfully Updated !!','url'=> route('admin.transactions.index')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>false ,'msg'=>$e->getMessage()]);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(!auth()->user()->can('expense_income.delete'))
        {
            abort('403', 'Unauthorized');
        }

        $purchase=Transaction::find($id);
        $purchase->delete();
        return response()->json(['status'=>true ,'msg'=>'Deleted Successfully !!']);
        
    }


}
