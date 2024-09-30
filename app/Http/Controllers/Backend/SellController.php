<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionLine;
use App\Models\TransactionPayment;
use App\Models\Customer;
use App\Utils\Util;

use Illuminate\Support\Facades\DB;

class SellController extends Controller {

    public $util;

    public function __construct(Util $util){
        $this->util=$util;
    }

    public function index()
    {
        $items=Transaction::where('type','sell')->with('lines')->paginate(30);
        return view('backend.sells.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        if(!auth()->user()->can('sells.create'))
        {
            abort('403', 'Unauthorized');
        }
        
        $customers=Customer::where('type','customer')->select('phone','name','id')->get();

        return view('backend.sells.create', compact('customers'));
    }

    public function getSellProduct(Request $request){

        $data = Product::select("id",'name as value')
                    ->where('quantity','>',0)
                    ->where('products.name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();

    
        return response()->json($data); 

    }


    public function sellProductEntry(Request $request){

        $id=$request->id;
        $product=Product::where('quantity','>',0)->findOrFail($id);

        $price=$product->sell_price;
 
        if ($product) {
            $html='<tr><td>'.$product->name.'</td>
                    <td>
                        <input class="form-control quantity" name="quantity[]" type="number" data-qty="'.$product->quantity.'" value="1" required min="1"/>
                        <input type="hidden" class="form-control" name="product_id[]" type="number" value="'.$product->id.'" required/>
                        <input type="hidden" class="form-control" name="p_price[]" type="number" value="'.$product->purchase_price.'"/>
                    </td>
                    <td><input class="form-control unit_price" name="unit_price[]" type="number" value="'.$price.'" required/></td>
                    <td class="row_total">'.$price.'</td>
                    <td><a class="remove btn btn-sm btn-danger"> - </a></td>
                    </tr> ';

            return response()->json(['success'=>true,'html'=>$html]);
        }else{
            return response()->json(['success'=>false,'msg'=>'Product Stock Not Available !!']);
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
        if(!auth()->user()->can('sells.create'))
        {
            abort('403', 'Unauthorized');
        }

        $business_id=getBusinessId();
        $data=$request->validate([
             'note'=> '',
             'discount_amount'=> '',
             'date'=> 'required',
             'amount'=> 'required|numeric',
             'invoice_no'=> '',
             'product_id'=> 'required',
             'contact_id'=> 'required',
        ]);
     
        $data['user_id']=auth()->user()->id;
        $data['type']='sell';
        if(empty($request->invoice_no))
        {
            $data['invoice_no'] = rand(111111,999999);
        }

        DB::beginTransaction();

        try {
            unset($data['product_id']);

            $data['date']=newdate($data['date']);

            $sell=Transaction::create($data);

            if (isset($request->product_id)) {
                $data=[];

                foreach ($request->product_id as $key => $product_id) {
                    $qty=$request->quantity[$key];
                    $data[]=[
                        'product_id'=>$product_id,
                        'quantity'=>$qty,
                        'price'=>$request->unit_price[$key],
                        'p_price'=>$request->p_price[$key],

                    ];
                    $product=Product::find($product_id);
                    $product->quantity -=$qty;
                    $product->save();
                }
                $sell->lines()->createMany($data);
            }


            if (!empty(request('pay_amount'))) {
                
                $pay=[
                    'date'=>$sell->date,
                    'transaction_id'=>$sell->id,
                    'amount'=>$request->pay_amount,
                    'method'=>$request->method,
                    'note'=>$request->pay_note

                ];
                TransactionPayment::create($pay);
            }

            transactionStatus($sell);

            // $this->util->sendNotification($business_id,$sell,'sell');
            
            DB::commit();
            $url=route('admin.sellInvoice',[$sell->id]);
            
            return response()->json(['status'=>true ,'msg'=>'sell Is  Created !!','url'=> $url]);
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
        $item = Transaction::findOrFail($id);
        return view('backend.sells.show', compact('item'));
    }
    
    public function sellInvoice($id){
        
        $item = Transaction::findOrFail($id);
        return view('backend.sells.invoice', compact('item'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('sells.edit'))
        {
            abort('403', 'Unauthorized');
        }

        $item=Transaction::with('lines')->find($id);
        $customers=Customer::select('phone','name','id')->get();
        return view('backend.sells.edit', compact('customers','item'));
        
    }


    public function update(Request $request, $id)
    {
        if(!auth()->user()->can('sells.edit'))
        {
            abort('403', 'Unauthorized');
        }

        $sell=Transaction::find($id);
        $data=$request->validate([
             'note'=> '',
             'discount_amount'=> 'required',
             'date'=> 'required',
             'amount'=> 'required|numeric',
             'invoice_no'=> '',
             'product_id'=> 'required',
             'contact_id'=> 'required',
        ]);


         DB::beginTransaction();

        try {
            unset($data['product_id']);

            $data['date']=newdate($data['date']);


            $sell->update($data);

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
                foreach ($sell->lines as $key => $line) {
                    $product=Product::find($line->product_id);
                    $product->quantity+=$line->quantity;
                    $product->save();
                    $line->delete();
                }
            }


            // update sells line and product stock
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
                        $product->quantity-=$stock;
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
                            'p_price'=>$request->p_price[$key],
                        ];
                        

                        $product=Product::find($product_id);
                        $product->quantity-=$qty;
                        $product->save();

                    }
                    
                }
                if (!empty($data)) {
                    $sell->lines()->createMany($data);
                }
                
            }


            if(isset($request->pay_amount)){

                foreach ($request->pay_amount as $key => $amount) {
                    if(isset($request->pay_id[$key])){
                        $pay=TransactionPayment::find($request->pay_id[$key]);
                    }else{
                        $pay=new TransactionPayment();
                    }
                    
                    $pay->transaction_id=$sell->id;
                    $pay->date=$sell->date;
                    $pay->method=$request->method[$key];
                    $pay->amount=$amount;
                    $pay->note=$request->pay_note[$key];
                    $pay->save();

                }
            }
            transactionStatus($sell);

            DB::commit();
            return response()->json(['status'=>true ,'msg'=>'sell Is  Updated !!','url'=> route('admin.sells.index')]);
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
        if(!auth()->user()->can('sells.delete'))
        {
            abort('403', 'Unauthorized');
        }

        $sell=Transaction::find($id);

        foreach ($sell->lines as $key => $line) {
            
            $product=Product::find($line->product_id);
            $product->quantity +=$line->quantity;
            $product->save();

            $line->delete();
        }

        $sell->payments()->delete();
        $sell->delete();
        return response()->json(['status'=>true ,'msg'=>'Deleted Successfully !!']);
        
    }


}
