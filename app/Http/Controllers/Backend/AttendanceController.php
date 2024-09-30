<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\Membership;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(){
        $query = Attendance::latest();

        $data['items']=$query->paginate(30);
        return view('backend.attendance.index',$data);
    }
 
    public function create(Request $request){

        $employees=Membership::get();
        return view('backend.attendance.create', compact('employees'));

    }


    public function store(Request $request){

        
        $data=$request->validate([
             'date'=> 'required',
        ]);

        DB::beginTransaction();

        try {
            $data['date']=newdate($data['date']);
            
            $attendance=Attendance::where($data)->first();
            if (empty($attendance)) {
                $data['user_id']=auth()->user()->id;
                $data['date']=$data['date'];
                $attendance=Attendance::create($data);
            }else{
                $attendance->update($data);
            }



            if (isset($request->ids)) {

                foreach ($request->ids as $key => $id) {
                    $item=$attendance->details()->where('employee_id',$id)->first();
                    if ($item) {
                        $item->check_in=$request->check_in[$key];
                        $item->save();
                    }else{
                        $item=new AttendanceDetails();
                        $item->employee_id=$id;
                        $item->attendance_id=$attendance->id;
                        $item->check_in=$request->check_in[$key];
                        $item->status=$request->status[$key];
                        $item->save();

                    }
                }

                $attendance->details()->whereNotIn('employee_id', $request->ids)->delete();
            }
            DB::commit();
            return response()->json(['status'=>1, 'msg'=>'Worker Attendance Created Successfully','url'=>route('admin.attendance.index')]);


        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>0, 'msg'=>$e->getMessage()]);

        }    
    }



     public function edit($id){
        $data['item'] = Attendance::with('details')->findOrFail($id);
        $data['employees']=Membership::get();
        return view('backend.attendance.edit',$data);
    }

    public function update(Request $request,$id){

        $attendance=Attendance::find($id);

        $data=$request->validate([
             'date'=> 'required',
        ]);

        DB::beginTransaction();

        try {
            $data['date']=newdate($data['date']);
            $attendance->update($data);
            



            if (isset($request->ids)) {

                foreach ($request->ids as $key => $id) {
                    $item=$attendance->details()->where('employee_id',$id)->first();
                    if ($item) {
                        $item->check_in=$request->check_in[$key];
                        $item->status=$request->status[$key];
                        $item->save();
                    }else{
                        $item=new AttendanceDetails();
                        $item->employee_id=$id;
                        $item->attendance_id=$attendance->id;
                        $item->check_in=$request->check_in[$key];
                        $item->status=$request->status[$key];
                        $item->save();

                    }
                }

                $attendance->details()->whereNotIn('employee_id', $request->ids)->delete();
            }
            DB::commit();
            return response()->json(['status'=>1, 'msg'=>'Worker Attendance Updated Successfully','url'=>route('admin.attendance.index')]);


        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status'=>0, 'msg'=>$e->getMessage()]);

        } 


    }

     
    
    public function show($id){
        $data['item'] = Attendance::findOrFail($id);
        
        $search=request('q');
        $data['items'] = AttendanceDetails::where('attendance_id',$id)->get();
            
        if($search){
            $data['items'] = AttendanceDetails::where('attendance_id',$id)->whereHas('member', function($q) use($search)
            {
                $q->where('member_id', 'Like','%'.$search.'%')
                    ->orwhere('name', 'Like','%'.$search.'%')
                    ->orwhere('phone', 'Like','%'.$search.'%');
            
            })->get();

        }
        
        return view('backend.attendance.show',$data);
    }

    public function destroy($id){
        $item= Attendance::with('details')->findOrFail($id);
        $item->details()->delete();
        $item->delete();
        return response()->json(['status'=>1, 'msg'=>'Worker Attendance Deleted Successfully']);
    }



}
