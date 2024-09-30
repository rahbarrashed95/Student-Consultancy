<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDetails extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function employee(){

        return $this->belongsTo(Employee::class);
    }
    
    public function member(){

        return $this->belongsTo(Membership::class,'member_id');
    }

}
