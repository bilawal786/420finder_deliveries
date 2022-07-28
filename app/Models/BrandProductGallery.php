<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandProductGallery extends Model
{
    use HasFactory;

    public function brandproduct() {

        return $this->belongsTo('App\Models\BrandProduct');

    }

}
