<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApproveController extends Controller
{
    // Approve Failed
    public function approveFailed() {
        if(Session::has('business_id')) {
            $businessId = Session::get("business_id");
            $business = Business::where('id', $businessId)->first();
            if($business->approve) {
                return redirect()->route('index');
            } else {
                return view('approve.failed');
            }
        }
    }
}
