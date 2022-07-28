<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller {
    
    public function index() {

        $brands = Brand::where('status', 1)->select('id', 'name')->get();

        return view('requestproducts.index')
            ->with('brands', $brands);

    }

}
