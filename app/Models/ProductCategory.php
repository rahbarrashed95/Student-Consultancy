<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function measurements(){

        return $this->hasMany(Measurement::class,'category_id');
    }

    public function designs(){

        return $this->hasMany(Design::class,'category_id');
    }

}
