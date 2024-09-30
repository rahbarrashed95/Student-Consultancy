<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    use HasFactory;
    protected $guarded=[];


    public function type(){

        return $this->belongsTo(MembershipType::class,'type_id');
    }
    
    public function payments(){

        return $this->hasMany(TransactionPayment::class,'membership_id');
    }

}
