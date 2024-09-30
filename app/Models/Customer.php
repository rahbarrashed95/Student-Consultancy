<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function orders(){

        return $this->hasMany(Transaction::class,'contact_id');
    }

    public function purchases(){

        return $this->hasMany(Transaction::class,'contact_id');
    }

}
