<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function contact(){ 

        return $this->belongsTo(Customer::class,'contact_id');
    }

    public function customer(){ 

        return $this->belongsTo(Customer::class,'contact_id');
    }

    public function category(){

        return $this->belongsTo(ExpenseCategory::class,'expense_category_id');
    }


    public function lines(){

        return $this->hasMany(TransactionLine::class,'transaction_id');
    }

    public function products(){

        return $this->hasMany(TransactionLine::class,'transaction_id');
    }

    public function payments(){

        return $this->hasMany(TransactionPayment::class,'transaction_id');
    }

    public function categories(){ 

        return $this->hasMany(OrderCategory::class,'transaction_id');
    }

    public function user(){

        return $this->belongsTo(User::class);
    }


    

}
