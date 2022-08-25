<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Business;

use App\Models\StoreLocation;

use Image;

class AccountController extends Controller {

    public function index() {

        $business = Business::where('id', session('business_id'))->first();
        $latitude = $business->latitude;
        $longitude = $business->longitude;
        $url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCrAR67o9XfYUXH6u66iVXYhqsOzse6Uz8&latlng={$latitude},{$longitude}&sensor=false";
        $json = @file_get_contents($url);
        $data = json_decode($json);
        if($data == null){
            $location = 'Select location';
        }else{
            $location = $data->results[3]->formatted_address;
        }
        return view('account.index')
            ->with('business', $business)
            ->with('location', $location);

    }

    public function updateprofilepicture(Request $request) {

        $business = Business::find(session('business_id'));

        if($request->hasFile('profile_picture')) {

            $avatar = $request->file('profile_picture');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(770,218)->save(public_path('images/dispensery/profile/' . $filename));

            $business->profile_picture = asset("images/dispensery/profile/" . $filename);

            $business->save();

            return redirect()->back()->with('info', 'Profile Picture Updated.');

        }

    }

    public function savefirstname(Request $request) {

        $firstname = Business::find(session('business_id'));

        $firstname->first_name = $request->first_name;

        $firstname->save();

        return redirect()->back()->with('info', 'First Name Updated.');

    }

    public function savelastname(Request $request) {

        $lastname = Business::find(session('business_id'));

        $lastname->last_name = $request->last_name;

        $lastname->save();

        return redirect()->back()->with('info', 'Last Name Updated.');

    }

    public function updateEmail(Request $request) {

        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        $checkIfEmailExists = Business::where('email', $validated['email'])->where('business_type', 'delivery')->count();

        if($checkIfEmailExists) {
            return redirect()->back()->with('error', 'Email already exists.');
        }

        $email = Business::find(session('business_id'));

        $email->email = $request->email;

        $saved = $email->save();

        if($saved) {
            return redirect()->back()->with('info', 'Email Updated.');
        } else {
            return redirect()->back()->with('error', 'Sorry something went wrong.');
        }
    }

    public function savephonenumber(Request $request) {

        $phone_number = Business::find(session('business_id'));

        $phone_number->phone_number = $request->phone_number;

        $phone_number->save();

        return redirect()->back()->with('info', 'Phone Number Updated.');

    }

    public function updatebusinessname(Request $request) {

        $business_name = Business::find(session('business_id'));

        $business_name->business_name = $request->business_name;

        $business_name->save();

        return redirect()->back()->with('info', 'Business Name Updated.');

    }

    public function updateBusinessPhone(Request $request) {

        $validated = $request->validate([
            'business_phone_number' => 'required'
        ]);

        $phone = Business::find(session('business_id'));

        $phone->business_phone_number = $request->business_phone_number;

        $saved = $phone->save();

        if($saved) {
            return redirect()->back()->with('info', 'Business Phone Updated.');
        } else {
            return redirect()->back()->with('error', 'Sorry something went wrong.');
        }
    }

    public function updateaddressone(Request $request) {

        $address_line_1 = Business::find(session('business_id'));

        $address_line_1->address_line_1 = $request->address_line_1;

        $address_line_1->save();

        return redirect()->back()->with('info', 'Address One Updated.');

    }

    public function updateaddresstwo(Request $request) {

        $address_line_2 = Business::find(session('business_id'));

        $address_line_2->address_line_2 = $request->address_line_2;

        $address_line_2->save();

        return redirect()->back()->with('info', 'Address Two Updated.');

    }

    public function updatewebsiteurl(Request $request) {

        $website = Business::find(session('business_id'));

        $website->website = $request->website;

        $website->save();

        return redirect()->back()->with('info', 'Website URL Updated.');

    }

    public function updateinstagramurl(Request $request) {

        $instagram = Business::find(session('business_id'));

        $instagram->instagram = $request->instagram;

        $instagram->save();

        return redirect()->back()->with('info', 'Instagram URL Updated.');

    }

    public function updateordermethod(Request $request) {

        $order_method = $request->order_method;

        if ($order_method == 0) {

            $updatedelivery = Business::find(session('business_id'));

            $updatedelivery->delivery = 0;

            $updatedelivery->save();

            $updateorderonline = Business::find(session('business_id'));

            $updateorderonline->order_online = 0;

            $updateorderonline->save();

        } else {

            $updatedelivery = Business::find(session('business_id'));

            $updatedelivery->delivery = 1;

            $updatedelivery->save();

            $updateorderonline = Business::find(session('business_id'));

            $updateorderonline->order_online = 0;

            $updateorderonline->save();

        }

        return redirect()->back()->with('info', 'Order Method Updated.');

    }

    public function updateopeningtime(Request $request) {

        $business = Business::find(session('business_id'));

        $business->opening_time = $request->opening_time;

        $business->save();

        return redirect()->back()->with('info', 'Opening Time Updated.');

    }

    public function updateclosingtime(Request $request) {

        $business = Business::find(session('business_id'));

        $business->closing_time = $request->closing_time;

        $business->save();

        return redirect()->back()->with('info', 'Closing Time Updated.');

    }

    public function savebcoordinates(Request $request) {

        $business = Business::find(session('business_id'));

        $business->latitude = $request->latitude;

        $business->longitude = $request->longitude;

        $business->save();

        $response = ['statuscode'=> 200, 'message'=> 'Business Direction Updated.'];

        echo json_encode($response);

    }

    public function otherlocations() {

        $locations = StoreLocation::all();

        return view('account.otherlocations')
            ->with('locations', $locations);

    }

    public function storelocation(Request $request) {

        $location = new StoreLocation;

        $location->retailer_id = $request->retailer_id;
        $location->store_name = $request->store_name;
        $location->location = $request->location;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;

        $location->save();

        return redirect()->back()->with('info', 'Store with location added.');

    }

    public function deletelocation($id) {

        $location = StoreLocation::find($id);

        $location->delete();

        return redirect()->back()->with('info', 'Store Location Removed.');

    }

}
