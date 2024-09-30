<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Membership;
Use App\Models\MembershipType;
Use App\Models\TransactionPayment;

class MembershipController extends Controller
{
    public function index(Request $request){   
        
        if ($request->ajax()) {
            $type_id=$request->type_id;
            $start=$request->start;
            $end=$request->end;

            $exstart=$request->exstart;
            $exend=$request->exend;
            $q=$request->q;

            $query=Membership::query();
                if($type_id){
                    $query->where('type_id', $type_id);
                }

                if($start && $end){
                    $query->whereDate('start_at', '>=', $start)
                            ->whereDate('start_at', '<=', $end);
                }

                if($exstart && $exend){
                    $query->whereDate('expired_at', '>=', $exstart)
                            ->whereDate('expired_at', '<=', $exend);
                }

                if ($q) {
                    $query->where(function($row) use($q){
                        $row->where('member_id',$q);
                        $row->orwhere('name','Like','%'.$q.'%');
                        $row->orwhere('phone','Like','%'.$q.'%');
                        $row->orwhere('email','Like','%'.$q.'%');
                        $row->orwhere('fax','Like','%'.$q.'%');
                    });
                }

            $items=$query->latest()->paginate(40);

            $html=view('backend.memberships.partials.data', compact('items'))->render();
            return response()->json(['html'=>$html]);

        }
        $types=MembershipType::get();
        return view('backend.memberships.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types=MembershipType::get();
        return view('backend.memberships.create', compact('types'));
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
             'nid_image'=> '',
             'address'=> '',
             'phone'=> 'required',
             'member_id'=> 'nullable|unique:memberships',
             'type_id'=> 'required',
             'nationality'=> '',
             'dob'=> 'required|date',
             'office_tel'=> '',
             'office_address'=> '',
             'organization_name'=> '',
             'designation'=> '',
             'fax'=> '',
             'home_tel'=> '',
             'occupation'=> '',
             'birth_place'=> '',
             'start_at'=> '',
             'expired_at'=> '',
             'aim_member'=> 'required'
        ]);


        if($request->hasFile('image')) {
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('memberships'), $fileName);
            $data['image']=$fileName;
        }

        if($request->hasFile('nid_image')) {
            $originName = $request->file('nid_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('nid_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('nid_image')->move(public_path('memberships'), $fileName);
            $data['nid_image']=$fileName;
        }
        
        if($request->hasFile('nid_image_2')) {
            $originName = $request->file('nid_image_2')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('nid_image_2')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('nid_image_2')->move(public_path('memberships'), $fileName);
            $data['nid_image_2']=$fileName;
        }

        $item=Membership::create($data);
        
        if(empty($data['member_id'])){

            $item->member_id='0'.$item->id;
            $item->save();
        }
        
        return response()->json(['status'=>true ,'msg'=>'Membership Created !!', 'url'=> route('admin.memberships.index')]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item=Membership::with('payments')->find($id);
        
        return view('backend.memberships.show', compact('item'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Membership::find($id);
        $types=MembershipType::get();
        return view('backend.memberships.edit', compact('item','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        
        $item=Membership::find($id);
        $data=$request->validate([
             'name'=> 'required',
             'email'=> '',
             'image'=> '',
             'nid_image'=> '',
             'address'=> '',
             'phone'=> 'required',
             'member_id'=> 'nullable|unique:memberships,member_id,'.$id,
             'type_id'=> 'required',
             'nationality'=> '',
             'dob'=> 'required|date',
             'office_tel'=> '',
             'office_address'=> '',
             'organization_name'=> '',
             'designation'=> '',
             'fax'=> '',
             'home_tel'=> '',
             'occupation'=> '',
             'birth_place'=> '',
             'start_at'=> '',
             'expired_at'=> '',
             'status'=> '',
             'aim_member'=> 'required'
        ]);
        
        if(empty($data['member_id'])){
            $data['member_id']='0'.$item->id;
        }

        if($request->hasFile('image')) {

            deleteImage('memberships',$item->image);

            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('image')->move(public_path('memberships'), $fileName);
            $data['image']=$fileName;
        }

        if($request->hasFile('nid_image')) {

            deleteImage('memberships',$item->nid_image);
            
            $originName = $request->file('nid_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('nid_image')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('nid_image')->move(public_path('memberships'), $fileName);
            $data['nid_image']=$fileName;
        }
        
        if($request->hasFile('nid_image_2')) {

            deleteImage('memberships',$item->nid_image_2);
            
            $originName = $request->file('nid_image_2')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('nid_image_2')->getClientOriginalExtension();
            $fileName =$fileName.time().'.'.$extension;
        
            $request->file('nid_image_2')->move(public_path('memberships'), $fileName);
            $data['nid_image_2']=$fileName;
        }

  
        
        $item->update($data);

        return response()->json(['status'=>true ,'msg'=>'Membership Updated !!', 'url'=> route('admin.memberships.index')]);

    }

    public function destroy(string $id){
        $item=Membership::find($id);
        deleteImage('memberships',$item->image);
        deleteImage('memberships',$item->nid_image);
        $item->delete();
        return response()->json(['status'=>true ,'msg'=>'Membership Deleted !!']);
    }

    public function getPayment(Request $request){

        $items=Membership::latest()->select('id','name','phone')->get();

        if($request->ajax()){
            $id=$request->id;
            $item=Membership::find($id);
            $html=view('backend.memberships.payment_form', compact('item'))->render();
            return response()->json(['status'=>true ,'html'=>$html]);

        }

        return view('backend.memberships.payment', compact('items'));

    }

    public function storePayment(Request $request){

        $data=$request->validate([
             'membership_id'=> 'required',
             'method'=> 'required',
             'date'=> 'required',
             'transaction_no'=> '',
             'note'=> '',
             'amount'=> 'required|numeric',
        ]);
        $data['user_id']=auth()->user()->id;
        $data['type']='membership_payment';
        TransactionPayment::create($data);
        return response()->json(['status'=>true ,'msg'=>'Membership Payment Success !!']);
    }

    public function paymentList(){

        $items=TransactionPayment::with('membership','employee')
                                    ->where('membership_id','!=',null)
                                    ->Orwhere('membership_id','!=',null)
                                    ->latest()
                                    ->paginate(50);
        return view('backend.memberships.payment_list', compact('items'));
    }

}
