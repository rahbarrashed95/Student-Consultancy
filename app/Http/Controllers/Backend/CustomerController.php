<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Customer;
Use App\Models\Transaction;
Use App\Models\TransactionPayment;
use Illuminate\Support\Facades\DB; 
use App\Utils\Util;

class CustomerController extends Controller
{
    public $util;

    public function __construct(Util $util){
        $this->util=$util;
    }

    public function index(){   

        $items=Customer::where('type','customer')->latest()->get();
        return view('backend.customers.index', compact('items'));
    }

    public function getSuppliers(){

        $items=Customer::where('type','supplier')->latest()->get();
        return view('backend.customers.suppliers', compact('items'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type=request('type');
        return view('backend.customers.create', compact('type'));
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
             'info'=> '',
             'openning_balance'=> '',
             'type'=> '',
        ]);

        if($request->hasFile('image')) {
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('customers'), $fileName);
            $data['image']=$fileName;
        }


        Customer::create($data);

        return response()->json(['status'=>true ,'msg'=>'Customer Created !!']);

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
        $item=Customer::find($id);
        return view('backend.customers.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Customer::find($id);
        $data=$request->validate([
             'name'=> 'required',
             'email'=> '',
             'address'=> '',
             'phone'=> 'required',
             'info'=> '',
             'openning_balance'=> '',
        ]);

        if($request->hasFile('image')) {

            deleteImage('contacts',$item->image);

            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('contacts'), $fileName);
            $data['image']=$fileName;
        }

        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Customer Updated !!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $item=Customer::find($id); 
        
        deleteImage('contacts',$item->image);
        $item->delete();


        return response()->json(['status'=>true ,'msg'=>'Customer Deleted !!']);

    }

    public function dueCustomer(){

        $items=Customer::with('orders','orders.payments')->get();


        return view('backend.customers.due_list', compact('items'));
    }

    public function customerPayment($id){

        $customer=Customer::find($id);
        $sells=Transaction::where('contact_id',$id)
                        ->whereIn('type',['order','sell'])
                        ->select('id','amount','invoice_no','created_at',
                            DB::raw("((amount) - (SELECT IFNULL((SELECT SUM(amount) from transaction_payments where transaction_payments.transaction_id = transactions.id),0))) as due")
                        )
                        ->having('due', '>', 0)
                        ->get();

        return view('backend.customers.payment', compact('sells','customer'));

    }

    public function customerPaymentStore(Request $request,$customer_id){

        $data=$request->validate([
             'method'=> 'required',
             'amount'=> 'required',
             'account_id'=> 'required',
             'note'=> '',
             'date'=> '',
             'transaction_no'=> '',
        ]);
        $sell_id=request('sell_id');
        foreach ($sell_id as $key => $id) {
            $order=Transaction::find($id);
            $due=$order->amount- $order->payments->sum('amount');
            $data['transaction_id']=$id;
            $data['amount']=$due;
            $data['type']=$order->type;
            $data['user_id']=auth()->user()->id;
            TransactionPayment::create($data);
            transactionStatus($order);
        }
        return response()->json(['status'=>true ,'msg'=>'Order Payment Created !!']);
    }

    public function contactAdvance($id){
        $item=Customer::find($id);
        return view('backend.suppliers.openning_payment', compact('item'));
        
    }

    public function contactAdvanceStore(Request $request,$id){

        $data=$request->validate([
             'method'=> 'required',
             'amount'=> 'required',
             'account_id'=> 'required',
             'note'=> '',
             'date'=> '',
             'type'=> '',
             'transaction_no'=> '',
        ]);
        $data['contact_id']=$id;
        $data['user_id']=auth()->user()->id;
        TransactionPayment::create($data);
        return response()->json(['status'=>true ,'msg'=>'Openning Payment Created !!']);

    }

    public function contactSmsModal($id){

        $item=Customer::find($id);
        return view('backend.customers.sms_modal', compact('item'));

    }

    public function sendSMs($id){
        $item=Customer::find($id);
        $number=$item->phone;
        $message=request('message');
        $business_id=getBusinessId();
        $this->util->sendSms($business_id,$number,$message);

        return response()->json(['status'=>true ,'msg'=>'Sms Sned Success !!']);
    }


}
