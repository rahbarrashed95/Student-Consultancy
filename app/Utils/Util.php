<?php
namespace App\Utils;

use App\Models\SmsSetting;
use App\Models\Subscription;
use App\Models\NotificationTamplate;
use App\Models\Business;
use Illuminate\Support\Facades\Http;

class Util {

	public function sendSms($business_id,$number,$message){

		$item=SmsSetting::where('business_id',$business_id)->first();

		if($item){
			
			if($item->method=='get'){
				
				$response = Http::get($item->url, [
		            $item->send_to=>$number,
		            $item->message=>$message,
		            $item->key_1=>$item->key_value_1,
		            $item->key_2=>$item->key_value_2,
		            $item->key_3=>$item->key_value_3,
		            $item->key_4=>$item->key_value_4,
		        ]);

			}else if($item->method=='post'){

				$response = Http::post($item->url, [
		            $item->send_to=>$number,
		            $item->message=>$message,
		            $item->key_1=>$item->key_value_1,
		            $item->key_2=>$item->key_value_2,
		            $item->key_3=>$item->key_value_3,
		            $item->key_4=>$item->key_value_4,
		        ]);
			}
	    	return $response->successful();
		}
	
	}




	public function increaseProductStock($product_id,$variation_id, $stock){

		$item=ProductStock::where(['product_id'=>$product_id,'variation_id'=>$variation_id])->first();

		if ($item) {
			
		}else{
			$item=new ProductStock();
			$item->product_id=$product_id;
			$item->variation_id=$variation_id;
			$item->quantity=0;
		}

		$item->quantity+=$stock;
		$item->save();


		return true;

	}


	public function updateProductStock($product_id, $variation_id, $old_stock, $new_stock){

		$item=ProductStock::where(['product_id'=>$product_id, 'variation_id'=>$variation_id])->first();
		$stock=$new_stock -$old_stock;
		if ($stock !=0) {
			if ($item) {
				
			}else{
				$item=new ProductStock();
				$item->product_id=$product_id;
				$item->variation_id=$variation_id;
				$item->quantity=0;
			}

			$item->quantity +=$stock;
			$item->save();

		}
		return true;

		

	}


	public function decreaseProductStock($product_id, $variation_id, $stock){

		$item=ProductStock::where(['product_id'=>$product_id, 'variation_id'=>$variation_id])->first();

		if($item){
			$item->quantity-=$stock;
			$item->save();
		}
		
		return true;


	}


	public function checkProductStock($product_id, $variation_id){
		$item=ProductStock::where(['product_id'=>$product_id, 'variation_id'=>$variation_id])->first();
		return $item?$item->quantity:0;
	}

	public function subscriptionCheck(){

		$item=Subscription::where('business_id',getBusinessId())->orderby('end_date','desc')->first();
		$date=date('Y-m-d');

		if(($item) && ($item->end_date >=$date)){
			return true;
		}else{
			return false;
		}

	}

	public function sendNotification($business_id, $transaction, $type){

		$template=NotificationTamplate::where([
				'business_id'=>$business_id,
				'type'=>$type,
			])->first();

		if ($template) {
			$message=$template->body;
			$number='';
			if($type=='payment'){
        		if($transaction->worker){
        			$number=$transaction->worker->phone;
        		}else if($transaction->employee){
        			$number=$transaction->employee->phone;
        		}

        	}else if ($type=='order' || $type=='sell' || $type=='order_receive' || $type=='order_deliver') {
        		$number = $transaction->contact->phone;
        	
        	}else if($type=='worker_assign'){

        		if($transaction->worker){
        			$number=$transaction->worker->phone;
        		}

        	}


			$number = $number;
			$message=$this->replaceTags($business_id,$message,$transaction,$type);
			$this->sendSms($business_id,$number,$message);
		}

	}

	public function replaceTags($business_id, $message,$transaction,$type){
		
        $business = Business::findOrFail($business_id);
             //Replace contact name
            if (strpos($message, '{contact_name}') !== false) {
            	$contact_name='';
            	if($type=='payment'){
            		if($transaction->worker){
            			$contact_name=$transaction->worker->name;
            		}else if($transaction->employee){
            			$contact_name=$transaction->employee->name;
            		}

            		if (strpos($message, '{total_payment}') !== false) {
		                $total_payment = $transaction->amount;
		                $message = str_replace('{total_payment}', $total_payment, $message);
		            }

		            if (strpos($message, '{date}') !== false) {
		                $date = $transaction->date;
		                $message = str_replace('{date}', $date, $message);
		            }



            	}else if ($type=='order' || $type=='sell' || $type=='order_receive' || $type=='order_deliver') {
            		$contact_name = $transaction->contact->name;
            		if (strpos($message, '{invoice_no}') !== false) {
		                $invoice_no = $transaction->invoice_no;
		                $message = str_replace('{invoice_no}', $invoice_no, $message);
		            }

		            if (strpos($message, '{total_amount}') !== false) {
		                $total_amount = $transaction->amount;
		                $message = str_replace('{total_amount}', $total_amount, $message);
		            }

		            if (strpos($message, '{total_payment}') !== false) {
		                $total_payment = $transaction->payments->sum('amount');
		                $message = str_replace('{total_payment}', $total_payment, $message);
		            }

		            if (strpos($message, '{due}') !== false) {
		                $due = $transaction->amount - $transaction->payments->sum('amount');
		                $message = str_replace('{due}', $due, $message);
		            }


		            if (strpos($message, '{date}') !== false) {
		                $date = $transaction->date;
		                $message = str_replace('{date}', $date, $message);
		            }
                	
            	}else if($type=='worker_assign'){

            		if($transaction->worker){
            			$contact_name=$transaction->worker->name;
            		}

            		if (strpos($message, '{category_name}') !== false) {
		                $category_name=($transaction->order_category && $transaction->order_category->category) ? $transaction->order_category->category->name:'';
		                $message = str_replace('{category_name}', $category_name, $message);
		            }

		            if (strpos($message, '{total_amount}') !== false) {
		                $total_amount = $transaction->amount;
		                $message = str_replace('{total_amount}', $total_amount, $message);
		            }

		            if (strpos($message, '{date}') !== false) {
		                $date = date('d.m.Y');
		                $message = str_replace('{date}', $date, $message);
		            }

		            if (strpos($message, '{quantity}') !== false) {
		                $quantity=$transaction->quantity;
		                $message = str_replace('{quantity}', $quantity, $message);
		            }

		            if (strpos($message, '{invoice_no}') !== false) {
		                $invoice_no=$transaction->order_category->order->invoice_no;
		                $message = str_replace('{invoice_no}', $invoice_no, $message);
		            }

            		


            	}
            	$message = str_replace('{contact_name}', $contact_name, $message);
                
            }

        return $message;
    }




}