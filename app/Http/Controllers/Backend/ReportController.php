<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WorkerPayment;
use App\Models\TransactionPayment;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function profitLoss(Request $request){

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            

            $query=DB::table('transactions as t')
                    ->where('t.business_id',getBusinessId())
                    ->select('t.amount','t.type',

                    DB::raw("(SELECT SUM(amount) from transaction_payments where transaction_payments.transaction_id = t.id) as total_paid")
                );
            $worker_payment=TransactionPayment::join('workers','workers.id','transaction_payments.worker_id')
                            ->where('workers.business_id',getBusinessId())
                            ->select('amount');
            $emp_payment=TransactionPayment::join('employees','employees.id','transaction_payments.employee_id')
                            ->where('employees.business_id',getBusinessId())
                            ->select('amount');

                if($start && $end){
                    $query->whereDate('t.created_at', '>=', $start)
                            ->whereDate('t.created_at', '<=', $end);

                    $worker_payment->whereDate('transaction_payments.date', '>=', $start)
                            ->whereDate('transaction_payments.date', '<=', $end);

                    $emp_payment->whereDate('transaction_payments.date', '>=', $start)
                            ->whereDate('transaction_payments.date', '<=', $end);

                }

            $items=$query->get();
            $worker_total_paid=$worker_payment->sum('amount');
            $employee_total_paid=$emp_payment->sum('amount');
            
            $view= view('backend.reports.partials.profit_loss_data', compact('items','worker_total_paid','employee_total_paid'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.profit_loss');

    }
    public function workerPayment(Request $request){
        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;

            $query=DB::table('transaction_payments as wp')

                    ->join('workers','workers.id','wp.worker_id')
                    ->join('users','users.id','wp.user_id')
                    ->join('accounts','accounts.id','wp.account_id')
                    ->where('workers.business_id',getBusinessId())
                    ->select('users.name','workers.phone','workers.name as worker','wp.*','accounts.account_no','accounts.title');
                if($start && $end){
                    $query->whereDate('wp.date', '>=', $start)
                            ->whereDate('wp.date', '<=', $end);
                }

                if ($q) {
                    $query->where(function($row) use($q){
                        $row->where('workers.name','Like','%'.$q.'%');
                        $row->orwhere('workers.phone','Like','%'.$q.'%');
                        $row->orwhere('users.name','Like','%'.$q.'%');
                    });
                }
            $items=$query->latest()->paginate(40);
            $view= view('backend.reports.partials.worker_payment_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.worker_payment');
    }

    public function employeePayment(Request $request){

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;

            $query=DB::table('transaction_payments as wp')

                    ->join('employees','employees.id','wp.employee_id')
                    ->join('users','users.id','wp.user_id')
                    ->where('employees.business_id',getBusinessId())
                    ->select('users.name','employees.phone','employees.name as employee','wp.*');
                if($start && $end){
                    $query->whereDate('wp.date', '>=', $start)
                            ->whereDate('wp.date', '<=', $end);
                }

                if ($q) {
                    $query->where(function($row) use($q){
                        $row->where('employees.name','Like','%'.$q.'%');
                        $row->orwhere('employees.phone','Like','%'.$q.'%');
                        $row->orwhere('users.name','Like','%'.$q.'%');
                    });
                }
            $items=$query->latest()->paginate(40);
            $view= view('backend.reports.partials.employee_payment_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.employee_payment');

    }

    public function customerPayment(Request $request){
        

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;

            $query=DB::table('transaction_payments as tp')
                    ->Leftjoin('users','users.id','tp.user_id')
                    ->Leftjoin('transactions as t','t.id','tp.transaction_id')
                    ->Leftjoin('customers','customers.id','tp.contact_id')
                    ->where('customers.business_id',getBusinessId())
                    // ->where(function($row){
                    //     $row->where('tp.type','purchase');
                    // })
                    ->whereIn('tp.type',['order','sell','customer_openning'])
                    ->select('users.name','customers.phone','customers.name as supplier','tp.*','t.invoice_no','tp.type');
                if($start && $end){
                    $query->whereDate('tp.date', '>=', $start)
                            ->whereDate('tp.date', '<=', $end);
                }

                if ($q) {
                    $query->where(function($row) use($q){
                        $row->where('t.invoice_no','Like','%'.$q.'%');
                        $row->orwhere('customers.name','Like','%'.$q.'%');
                        $row->orwhere('customers.phone','Like','%'.$q.'%');
                        $row->orwhere('users.name','Like','%'.$q.'%');
                    });
                }
            $items=$query->latest()->paginate(40);
            $view= view('backend.reports.partials.customer_payment_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.customer_payment');
    }


    public function supplierPayment(Request $request){
        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;

            $query=DB::table('transaction_payments as tp')
                    ->Leftjoin('users','users.id','tp.user_id')
                    ->Leftjoin('transactions as t','t.id','tp.transaction_id')
                    ->Leftjoin('customers','customers.id','tp.contact_id')
                    ->where('customers.business_id',getBusinessId())
                    // ->where(function($row){
                    //     $row->where('tp.type','purchase');
                    // })
                    ->whereIn('tp.type',['purchase','supplier_openning'])
                    ->select('users.name','customers.phone','customers.name as supplier','tp.*','t.invoice_no','tp.type');
                if($start && $end){
                    $query->whereDate('tp.date', '>=', $start)
                            ->whereDate('tp.date', '<=', $end);
                }

                if ($q) {
                    $query->where(function($row) use($q){
                        $row->where('t.invoice_no','Like','%'.$q.'%');
                        $row->orwhere('customers.name','Like','%'.$q.'%');
                        $row->orwhere('customers.phone','Like','%'.$q.'%');
                        $row->orwhere('users.name','Like','%'.$q.'%');
                    });
                }
            $items=$query->latest()->paginate(40);
            $view= view('backend.reports.partials.supplier_payment_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.supplier_payment');
        
    }

    public function productSell(Request $request){

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;

            $query=DB::table('transaction_lines as tl')
                    ->join('transactions as t','t.id','tl.transaction_id')
                    ->join('users','users.id','t.user_id')
                    ->join('customers','customers.id','t.contact_id')
                    ->join('products','products.id','tl.product_id')
                    ->whereIn('t.type',['sell','order'])
                    ->select('users.name','products.name as product','customers.phone','customers.name as customer','tl.*','t.invoice_no',

                    DB::raw("sum(tl.quantity * tl.price) as sub_total"),
                    DB::raw("sum(tl.quantity * tl.p_price) as sub_total_p"),
                    DB::raw("sum(tl.quantity * (tl.price-tl.p_price)) as profit")
                );
                if($start && $end){
                    $query->whereDate('tl.created_at', '>=', $start)
                            ->whereDate('tl.created_at', '<=', $end);
                }

                if ($q) {
                    $query->where(function($row) use($q){
                        $row->where('t.invoice_no','Like','%'.$q.'%');
                        $row->orwhere('customers.name','Like','%'.$q.'%');
                        $row->orwhere('products.name','Like','%'.$q.'%');
                        $row->orwhere('customers.phone','Like','%'.$q.'%');
                        $row->orwhere('users.name','Like','%'.$q.'%');
                    });
                }
            $items=$query->groupBy('tl.id')->latest()->paginate(40);
            $view= view('backend.reports.partials.product_sell_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.product_sell');
    }

    public function categorySell(Request $request){

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;

            $query=DB::table('order_categories as ot')
                    ->join('transactions as t','t.id','ot.transaction_id')
                    ->join('users','users.id','t.user_id')
                    ->join('customers','customers.id','t.contact_id')
                    ->join('product_categories','product_categories.id','ot.category_id')
                    ->where('t.business_id',getBusinessId())
                    ->whereIn('t.type',['order'])
                    ->select('users.name','product_categories.name as category','customers.phone','customers.name as customer','ot.*','t.invoice_no',

                    DB::raw("sum(ot.quantity * ot.price) as sub_total"),
                    DB::raw("sum(ot.quantity * ot.p_price) as sub_total_p"),
                    DB::raw("sum(ot.quantity * (ot.price-ot.p_price)) as profit")
                );
                if($start && $end){
                    $query->whereDate('ot.created_at', '>=', $start)
                            ->whereDate('ot.created_at', '<=', $end);
                }

                if ($q) {
                    $query->where(function($row) use($q){
                        $row->where('t.invoice_no','Like','%'.$q.'%');
                        $row->orwhere('customers.name','Like','%'.$q.'%');
                        $row->orwhere('product_categories.name','Like','%'.$q.'%');
                        $row->orwhere('customers.phone','Like','%'.$q.'%');
                        $row->orwhere('users.name','Like','%'.$q.'%');
                    });
                }
            $items=$query->groupBy('ot.id')->latest()->paginate(40);
            $view= view('backend.reports.partials.category_sell_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.category_sell');
    }

    public function accountTransfer(Request $request){

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;
            $type=$request->type;

            $query=DB::table('account_transfers as at')

                    ->leftjoin('accounts as from','from.id','at.from_account_id')
                    ->leftjoin('accounts as to','to.id','at.to_account_id')
                    ->join('users','users.id','at.user_id')
                    ->where('at.business_id',getBusinessId())
                    ->select('users.name','from.account_no as from_account','to.account_no as to_account','at.*');
                if($start && $end){
                    $query->whereDate('at.date', '>=', $start)
                            ->whereDate('at.date', '<=', $end);
                }

                if ($q) {
                    $query->where(function($row) use($q){
                        $row->where('to.account_no','Like','%'.$q.'%');
                        $row->orwhere('from.account_no','Like','%'.$q.'%');
                        $row->orwhere('users.name','Like','%'.$q.'%');
                    });
                }

                if ($type) {
                    $query->where('at.type', $type);
                }
            $items=$query->latest()->paginate(40);
            $view= view('backend.reports.partials.account_transfer', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.account_transfer');

    }

    public function productSTock(Request $request){

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            

            $query=DB::table('products as p')
                    ->select('p.name','p.sku','p.quantity','p.sell_price','p.purchase_price',

                    DB::raw("(SELECT SUM(quantity) from transaction_lines 
                            JOIN transactions ON transaction_lines.transaction_id=transactions.id
                            where transaction_lines.product_id = p.id AND (transactions.type='sell' or transactions.type='order')) as total_sell"),

                    DB::raw("(SELECT SUM(quantity) from transaction_lines 
                            JOIN transactions ON transaction_lines.transaction_id=transactions.id
                            where transaction_lines.product_id = p.id AND (transactions.type='purchase')) as total_purchase"),
                );


            $items=$query->paginate(40);
            
            $view= view('backend.reports.partials.product_stock_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.product_stock');

    }


     public function employeePaymentHistory(Request $request){

    $query=DB::table('transaction_payments as wp')

                    ->join('employees','employees.id','wp.employee_id')
                    ->join('users','users.id','wp.user_id')
                    ->where('employees.business_id',getBusinessId())
                    ->select('users.name','employees.phone','employees.name as employee','wp.*');
        return view('backend.reports.employee_payment_history', compact('query'));

    }

    public function allPayment(Request $request){
        $types=DB::table('transaction_payments as wp')
                    ->leftjoin('users','users.id','wp.user_id')
                    ->groupBy('type')->pluck('type')->toArray();

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;
            $type=$request->type;
            $query=DB::table('transaction_payments as wp')

                    ->Leftjoin('employees','employees.id','wp.employee_id')
                    ->leftjoin('users','users.id','wp.user_id')
           
                    ->select('users.name','employees.phone','employees.name as employee','wp.*');
                if($start && $end){
                    $query->whereDate('wp.date', '>=', $start)
                            ->whereDate('wp.date', '<=', $end);
                }

                if (!empty($type)) {
                    $query->where('wp.type',$type);
                }

            $items=$query->latest()->paginate(40);

            
            $view= view('backend.reports.partials.all_payment_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.all_payment', compact('types'));

    }

    public function expenseReport(Request $request){

        if ($request->ajax()) {
            $start=$request->start;
            $end=$request->end;
            $q=$request->q;
            $status=$request->status;
            $query=Transaction::leftjoin('customers as c','c.id','transactions.contact_id')
                        ->leftjoin('users as u','u.id','transactions.user_id')
                        ->where('transactions.type','expense')
                        
                        ->select('transactions.*','c.name as customer_name','c.phone','u.name');
                        if($start && $end){

                            $query->whereDate('transactions.date', '>=', $start)
                                    ->whereDate('transactions.date', '<=', $end);

                        }
                        if ($q) {
                            $query->where(function($row) use($q){
                                $row->where('transactions.invoice_no','Like','%'.$q.'%');
                                $row->orwhere('c.name','Like','%'.$q.'%');
                                $row->orwhere('c.phone','Like','%'.$q.'%');
                                $row->orwhere('u.name','Like','%'.$q.'%');
                            });
                        }

                        if($status=='delivered'){
                            $query->where('transactions.status','delivered');
                        }else{
                            $query->where('transactions.status','!=','delivered');
                        }
            $items=$query->latest()->paginate(50);

            
            $view= view('backend.reports.partials.expense_data', compact('items'))->render(); 
            return response()->json(['html'=>$view]);
        }

        return view('backend.reports.expense');

    }





}
