<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Models\Membership;
Use App\Models\Attendance;
Use App\Models\AttendanceDetails;

class ApiController extends Controller
{
    public function index(){
        
        return view('backend.api_attendance.index');
    }
    public function store(){

        
        $date=request()->date;
        
        $data = array("operation" => "fetch_user_list",
	                    "auth_user" => "Banglatech",
	                    "auth_code"=> "ze3ds39e9sehrxax1sjfk907p70q8gk",
                    );
        $datapayload = json_encode($data);
        $api_request = curl_init('https://rumytechnologies.com/rams/json_api');
        curl_setopt($api_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api_request, CURLINFO_HEADER_OUT, true);
        curl_setopt($api_request, CURLOPT_POST, true);
        curl_setopt($api_request, CURLOPT_POSTFIELDS, $datapayload);
        curl_setopt($api_request, CURLOPT_HTTPHEADER, array('Content-Type:
        application/json','Content-Length: ' . strlen($datapayload)));
        $result = curl_exec($api_request);
        
        // dd(json_decode($result));
        
        $replace_syntax = str_replace('{"user_list":',"",$result);
        // print_r($replace_syntax);
        $replace_syntax = substr($replace_syntax, 0, -1);
        // print_r($replace_syntax);
        $api_user_list = json_decode($replace_syntax);
        $attendance=Attendance::updateOrCreate(['date'=>$date],['user_id'=>1]);
        
        foreach($api_user_list as $u){
            
            
            
            $result=Membership::where('member_id', $u->registraton_id)->first();
            
            
            if($result){
                if($result->expired_at >= date('Y-m-d')){
                    $result->status=0;
                }
                $result->member_id=$u->registraton_id;
                $result->save();
                
            }else{
                $result=new Membership();
                $result->member_id=$u->registraton_id;
                $result->name=$u->username;
                $result->save();
                
            }
            
        }
        
        
     
        $date_from=$date;
        
        $data = array("operation" => "fetch_log",
	                    "auth_user" => "Banglatech",
	                    "auth_code"=> "ze3ds39e9sehrxax1sjfk907p70q8gk",
	                    "start_date" => $date_from,
	                    "end_date" => $date,
                    );
        $datapayload = json_encode($data);
        $api_request = curl_init('https://rumytechnologies.com/rams/json_api');
        curl_setopt($api_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($api_request, CURLINFO_HEADER_OUT, true);
        curl_setopt($api_request, CURLOPT_POST, true);
        curl_setopt($api_request, CURLOPT_POSTFIELDS, $datapayload);
        curl_setopt($api_request, CURLOPT_HTTPHEADER, array('Content-Type:
        application/json','Content-Length: ' . strlen($datapayload)));
        $logresult = curl_exec($api_request);
        
        $res = str_replace('{"log":',"",$logresult);
        $res = substr($res, 0, -1);
        $logs = json_decode($res);
        $user_ids=[];
        dd($logs);
        
        
        
        foreach($logs as $v){
            
            $member=Membership::where('member_id', $v->registration_id)->first();
            
        
            $att=AttendanceDetails::where('access_id',$v->access_id)->first();
            $user_ids[]=$member->id;
            
            if(empty($att)){
                $log_data=[
                    'attendance_id'=>$attendance->id,
                    'attendance_status'=>1,
                    'member_id'=>$member?$member->id:'',
                    'access_id'=>$v->access_id,
                    'check_in'=>$v->access_time,
                    'date'=>$v->access_date
                
                ];
                AttendanceDetails::create($log_data);
            }
        }
        
        // absent user 
        
        
        
        
        $present_em_id = AttendanceDetails::query()
                			->where('attendance_status', 1)
                			->whereDate('date',$date)
                			->groupBy('member_id')
                			->pluck('member_id')
                			->toArray();
        
   
        
        $absent_users = Membership::whereNotIn('id',$present_em_id)
            			->get(['id']);
        
        
        AttendanceDetails::where(['date'=>$date,'attendance_status'=>0])->whereIn('member_id',$present_em_id)->delete();
        foreach($absent_users as $absent_user){
            $check_data=[
                    'member_id'=>$absent_user->id,
                    'attendance_status'=>0,
                    'date'=>$date
                ];
                
            
            $log_data=[
                    'attendance_id'=>$attendance->id,
                    'check_in'=>date('H:i:s'),
                    'created_at'=>$date,
                    'updated_at'=>$date
                ];
            
            
            AttendanceDetails::updateOrCreate($check_data,$log_data);
                
        }
        
        return response()->json(['status'=>true ,'msg'=>'Attendance Get  Successfully !!']);
        
        
        
    }
}
