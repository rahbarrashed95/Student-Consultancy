<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function payments(){

        return $this->hasMany(TransactionPayment::class,'employee_id');
    }

    public function type(){

        return $this->belongsTo(EmployeeType::class,'employee_type_id');
    }

    public function thismonth(){

        return $this->hasMany(TransactionPayment::class,'employee_id')
                            ->whereMonth('date', date('m'))
                            ->whereYear('date', date('Y'))
                            ->where('type','salary');
    }

    

}
