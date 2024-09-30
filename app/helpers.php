<?php
use App\Models\Account;

function getInfo($key){

	$item=\Cache::get('info');

	return $item[$key]??'';
}


function dateFormate($date=null){
	$value='';
	if ($date) {
		$value=date('M d Y', strtotime($date));
	}
	return $value;
}

function newdate($date=null){
	$value=null;
	if ($date) {
		$value=date('Y-m-d', strtotime($date));
	}
	return $value;
}


function getImage($folder=null,$value=null){

	$url = asset('images/no_found.png');
	$path = public_path($folder.'/'.$value);
	if (!empty($folder) && (!empty($value))) {
		if(file_exists($path)){
			$url = asset($folder.'/'.$value);
		}
	}
	return $url;
}

function deleteImage($folder=null, $file=null){

    if (!empty($folder) && !empty($file)) {
        $path = public_path($folder.'/'.$file);
        $isExists = file_exists($path);
        if ($isExists) {
            unlink($path);
        }
    }
    return true;
}


function priceFormate($amount=0){
    
    return number_format($amount,0);
    
}

function getRole(){

	return auth()->user()->roles->pluck('name')[0] ??'';
}


function getMethods(){

	return [
		'cash'=>'Cash',
		
		'card'=>'Card',
		'bank'=>'Bank',
		'mobile_banking'=>'Mobile Banking',
	];
}

function getAims(){

	return [
		''=>'',
		1=>'Weight Loss',
		2=>'Increase Fitness',
		3=>'Recovery From Injury',
		4=>'Other',
	];
}





function orderStatus($order){

	if ($order) {
		$due=$order->final_amount - $order->payments()->sum('amount');
		if ($due==0) {
			$status='paid';
		}else if($due ==$order->final_amount){
			$status='due';
		}else{
			$status='partial';
		}

		$order->payment_status=$status;
		$order->save();
	}
	return true;

}


function transactionStatus($order){

	if ($order) {
		$due=$order->amount - $order->payments()->sum('amount');
		if ($due==0) {
			$status='paid';
		}else if($due ==$order->amount){
			$status='due';
		}else{
			$status='partial';
		}

		$order->payment_status=$status;
		$order->save();
	}
	return true;

}


function segment1($url){

	$res=request()->segment(2)==$url?'active':'';
	return $res;
}

function segmentsingle($url){

	$res=request()->segment(2)==$url && request()->segment(3)==null?'active':'';
	return $res;

}

function segmentMulti($url1,$url2){

	$res=request()->segment(2)==$url1 && request()->segment(3)==$url2?'active':'';
	return $res;

}

function segment2($url=null){

	$res=request()->segment(3)==$url?'active':'';
	return $res;
}

function getIndDate($num){
	$date=date('Y-m-d');

	if($num !=0){
		$date=date('Y-m-d', strtotime($date . ' +'.$num.' day'));
	}
	return $date;
}

function getBusinessId(){

	return auth()->user()->business_id;
}

function isSuperAdmin(){

	return auth()->user()->id==1 ?true:false;
}

function convert_number($number) 
    {
        if (($number < 0) || ($number > 999999999)) 
        {
            throw new Exception('Number is out of range');
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = '';
        if ($giga) 
        {
            $result .= convert_number($giga) .  'Million';
        }
        if ($kilo) 
        {
            $result .= (empty($result) ? '' : ' ') .convert_number($kilo) . ' Thousand';
        }
        if ($hecto) 
        {
            $result .= (empty($result) ? '' : ' ') .convert_number($hecto) . ' Hundred';
        }
        $ones = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eightteen', 'Nineteen');
        $tens = array('', '', 'Twenty', 'Thirty', 'Fourty', 'Fifty', 'Sixty', 'Seventy', 'Eigthy', 'Ninety');
        if ($deca || $n) {
            if (!empty($result)) 
            {
                $result .= ' and ';
            }
            if ($deca < 2) 
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) 
                {
                    $result .= '-' . $ones[$n];
                }
            }
        }
        if (empty($result)) 
        {
            $result = 'zero';
        }
        return $result;
    }










