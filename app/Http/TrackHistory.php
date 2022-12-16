<?php
namespace App\Http;

use App\Models\TrackingHistory;
use Location;

class TrackHistory
{
    public static function track_history($activity, $description)
    {
        $data = Location::get(request()->ip);
        $business_id = request()->session()->get('business_id');
        $lcoation = $data->countryName??"" . "," . $data->countryCode??"". "," .$data->regionCode??"" . "," . $data->regionName??"". "," . $data->cityName??"". "," . $data->zipCode??""."," . $data->latitude??"". "," .$data->longitude??"";
        $brower = $_SERVER['HTTP_USER_AGENT'];
        $history = new TrackingHistory();
        $history->buiseness_id = $business_id;
        $history->location = $lcoation??"Error";
        $history->ip = request()->ip();
        $history->browser = $brower??"Error";
        $history->activity = $activity;
        $history->description = $description;
        $history->save();
    }
}

?>
