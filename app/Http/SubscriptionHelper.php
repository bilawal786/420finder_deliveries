<?php

namespace App\Http;

use Illuminate\Support\Facades\DB;

class SubscriptionHelper
{
    public static function checkSubscription($business_id)
    {
        $date = DB::table('subscription_details')->orderBy('id', 'DESC')->where('retailer_id', '=', $business_id)->first();
        $currentDate = date('Y-m-d');
        $currentDate = date('Y-m-d', strtotime($currentDate));
        $startDate = date('Y-m-d', strtotime($date->starting_date ?? '12-2-2021'));
        $endDate = date('Y-m-d', strtotime($date->ending_date ?? '12-2-2021'));
        if (($currentDate >= $startDate) && ($currentDate <= $endDate)) {
            return true;
        } else {
            return false;
        }
    }
}


