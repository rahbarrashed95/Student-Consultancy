<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if($request->ajax()){

            $data['total_member']=DB::table('memberships')->count();
            $data['membership_payment']=DB::table('transaction_payments')
                                ->whereNotNull('membership_id')
                                ->whereYear('date', date('Y'))
                                ->whereMonth('date', date('m'))
                                ->sum('amount');

            $transaction=DB::table('transactions')
                        ->whereIn('type',['sell','expense'])
                        ->whereYear('date', date('Y'))
                        ->whereMonth('date', date('m'))
                        ->select('type','amount')
                        ->get();

            $data['total_expense']=$transaction->where('type','expense')->sum('amount');
            $data['total_sell']=$transaction->where('type','sell')->sum('amount');

            return response()->json($data);

        }

        return view('backend.dashboard');
    }

    public function ckeditor_upload(Request $request){



        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('ck-images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('ck-images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
    
}
