<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionLine;
use App\Models\TransactionPayment;
use App\Models\Customer;

use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller {


    public function index()
    {
        if(!auth()->user()->can('purchases.view'))
        {
            abort('403', 'Unauthorized');
        }

        $items=Transaction::where('type','purchase')->with('lines')->paginate(30);
        return view('backend.purchase.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->can('purchases.create'))
        {
            abort('403', 'Unauthorized');
        }
        
        $suppliers=Customer::where('type','supplier')->latest()->get();

        return view('backend.purchase.create', compact('suppliers'));
    }

    public function getPurchaseProduct(Request $request){

        $data = Product::select("id",'name as value')
                    ->where('products.name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();

    
        return response()->json($data); 

    }


    public function purchaseProductEntry(Request $request){

        $id=$request->id;
        $product=Product::find($id);

        if ($product) {
            $html='<tr><td>'.$product->name.'</td>
                    <td>
                        <input class="form-control quantity" name="quantity[]" type="number" value="1" required min="1"/>
                        <input type="hidden" class="form-control" name="product_id[]" type="number" value="'.$product->id.'" required/>
                    </td>
                    <td><input class="form-control unit_price" name="unit_price[]" type="number" value="'.$product->purchase_price.'" required/></td>
                    <td class="row_total">'.$product->purchase_price.'</td>
                    <td><a class="remove btn btn-sm btn-danger"> - </a></td>
                    </tr> ';

            return response()->json(['success'=>true,'html'=>$html]);
        }else{
            return response()->json(['success'=>false,'msg'=>'Product Note Found !!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('purchases.create'))
        {
            abort('403', 'Unauthorized');
        }

        $data=$request->validate([
             'note'=> '',
             'date'=> 'required',
             'amount'=> 'required|numeric',
             'invoice_no'=> '',
             'product_id'=> '',
             'contact_id'=> '',
        ]);
        $data['user_id']=auth()->user()->id;
        $data['type']='purchase';
        if(empty($request->invoice_no))
        {
            $data['invoice_no'] = rand(111111,999999);
        }

        DB::beginTransaction();

        try {

            unset($data['product_id']);
            $data['date']=newdate($data['date']);

            $purchase=Transaction::create($data);

            if (isset($request->product_id)) {
                $data=[];

                foreach ($request->product_id as $key => $product_id) {
                    $qty=$request->quantity[$key];
                    $data[]=[
                        'product_id'=>$product_id,
                        'quantity'=>$qty,
                        'price'=>$request->unit_price[$key],

                    ];
                    $product=Product::find($product_id);
                    $product->quantity+=$qty;
                    $product->save();
                }
                $purchase->lines()->createMany($data);
            }


            if (!empty(request('pay_amount'))) {
                
                $pay=[
                    'transaction_id'=>$purchase->id,
                    'date'=>$purchase->date,
                    'amount'=>$request->pay_amount,
                    'method'=>$request->method,
                    'note'=>$request->pay_note,
                ];
                TransactionPayment::create($pay);
            }

            transactionStatus($purchase);


            DB::commit();
            return response()->json(['status'=>true ,'msg'=>'Purchase Is  Created !!','url'=> route('admin.purchases.index')]);
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
        $purchases = DB::table('purchases')
                    ->join('suppliers', 'purchases.supplier_id', 'suppliers.id')
                    ->join('users', 'purchases.user_id', 'users.id')
                    ->where('purchases.id', $id)
                    ->select('purchases.*', 'suppliers.name', 'users.first_name', 'users.last_name')
                    ->get();

        $items=PurchaseLine::where('purchase_id', $id)->get();
        return view('backend.purchase.show', compact('items', 'purchases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('purchases.edit'))
        {
            abort('403', 'Unauthorized');
        }

        $item=Transaction::with('lines')->find($id);
        $suppliers=Customer::where('type','supplier')->latest()->get();
        return view('backend.purchase.edit', compact('suppliers','item'));
        
    }


    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('purchases.edit'))
        {
            abort('403', 'Unauthorized');
        }

        $purchase=Transaction::find($id);
        $data=$request->validate([
             'note'=> '',
             'date'=> 'required',
             'amount'=> 'required|numeric',
             'invoice_no'=> '',
             'product_id'=> '',
             'contact_id'=> '',
        ]);


         DB::beginTransaction();

        try {
            unset($data['product_id']);

            $data['date']=newdate($data['date']);
            $purchase->update($data);

            if (isset($request->line_id)) {
                $delete_line=TransactionLine::where('transaction_id', $id)
                                ->whereNotIn('id', $request->line_id)
                                ->get();


                if ($delete_line->count()) {
                    foreach ($delete_line as $key => $line) {

                        $product=Product::find($line->product_id);
                        $product->quantity-=$line->quantity;
                        $product->save();
                        $line->delete();
                    }
                }
            }
            else{
                foreach ($purchase->lines as $key => $line) {
                    $product=Product::find($line->product_id);
                    $product->quantity-=$line->quantity;
                    $product->save();
                    $line->delete();
                }
            }
            // update purchase line and product stock
            if (isset($request->product_id)) {
                $data=[];
                foreach ($request->product_id as $key => $product_id) {
                    //product stock increase/decrease
                    if (isset($request->line_id[$key])) {

                        
                        $qty=$request->quantity[$key];
                        $line_id=$request->line_id[$key];
                        $line=TransactionLine::find($line_id);

                        $stock=$qty -$line->quantity;

                        $product=Product::find($line->product_id);
                        $product->quantity+=$stock;
                        $product->save();

                        $line->quantity=$qty;
                        $line->price=$request->unit_price[$key];
                        $line->save();

                    }
                    //product stock increase
                    else{
                        $qty=$request->quantity[$key];
                        $data[]=[
                            'product_id'=>$product_id,
                            'quantity'=>$qty,
                            'price'=>$request->unit_price[$key],
                        ];

                        $product=Product::find($product_id);
                        $product->quantity+=$qty;
                        $product->save();                    
                    }
                    
                }
                if (!empty($data)) {
                    $purchase->lines()->createMany($data);
                }
                
            }

            if(isset($request->pay_amount)){

                foreach ($request->pay_amount as $key => $amount) {
                    if(isset($request->pay_id[$key])){
                        $pay=TransactionPayment::find($request->pay_id[$key]);
                    }else{
                        $pay=new TransactionPayment();
                    }
                    
                    $pay->transaction_id=$purchase->id;
                    $pay->date=$purchase->date;
                    $pay->method=$request->method[$key];
                    $pay->amount=$amount;
                    $pay->note=$request->pay_note[$key];
                    $pay->date=newdate($data['date']);
                    $pay->save();

                }
            }

            transactionStatus($purchase);

            DB::commit();
            return response()->json(['status'=>true ,'msg'=>'Purchase Is  Updated !!','url'=> route('admin.purchases.index')]);
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
        if(!auth()->user()->can('purchases.delete'))
        {
            abort('403', 'Unauthorized');
        }

        $purchase=Transaction::find($id);

        foreach ($purchase->lines as $key => $line) {
            
            $product=Product::find($line->product_id);
            $product->quantity -=$line->quantity;
            $product->save();

            $line->delete();
        }

        $purchase->payments()->delete();
        $purchase->delete();
        return response()->json(['status'=>true ,'msg'=>'Deleted Successfully !!']);
        
    }


}
