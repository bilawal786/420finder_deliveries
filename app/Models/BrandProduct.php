<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    use HasFactory;

    public function brand() {

        return $this->belongsTo('App\Models\Brand');

    }

    public function reviews() {

        return $this->hasMany('App\Models\BrandProductReview');

    }

    public function gallery() {

        return $this->hasMany('App\Models\BrandProductGallery');

    }

}
