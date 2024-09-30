<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionPayment;
use App\Utils\Util;

class OrderPaymentController extends Controller
{
    public $util;

    public function __construct(Util $util){
        $this->util=$util;
    }



    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $item=Transaction::find($id);
        $due=$item->amount - $item->payments->sum('amount');
        return view('backend.transactions.payment_form', compact('item','due')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $business_id=getBusinessId();
        $order=Transaction::find($id);
        $data=$request->validate([
             'method'=> 'required',
             'amount'=> 'required',
             'note'=> '',
             'date'=> '',
             'transaction_no'=> '',
        ]);
        $data['transaction_id']=$id;

        $data['user_id']=auth()->user()->id;
        
        $pay=TransactionPayment::create($data);
        transactionStatus($order);
        // $this->util->sendNotification($business_id,$pay,'payment');

        return response()->json(['status'=>true ,'msg'=>'Transaction Payment Created !!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
