<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function business() {

        return $this->belongsTo('App\Models\Business');

    }

    public function products() {

        return $this->hasMany('App\Models\BrandProduct');

    }

}
