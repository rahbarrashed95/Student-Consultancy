<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    use HasFactory;
    protected $guarded=[];  

    public function contact(){

        return $this->belongsTo(Customer::class);
    }

    public function worker(){

        return $this->belongsTo(Worker::class);
    }

    public function employee(){

        return $this->belongsTo(Employee::class);
    }

    public function membership(){

        return $this->belongsTo(Membership::class,'membership_id');
    }

}
