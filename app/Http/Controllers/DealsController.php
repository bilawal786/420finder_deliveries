<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\DispenseryProduct;
use Exception;
use Illuminate\Support\Facades\DB;
use Image;

use Carbon\Carbon;
use App\Models\Deal;
use App\Models\DealOrder;
use App\Models\DealProduct;
use Illuminate\Http\Request;
use App\Models\DeliveryProducts;
use App\Services\AuthorizeService;
use Illuminate\Support\Facades\File;

class DealsController extends Controller {

    public function index() {

        $deals = Deal::where('retailer_id', session('business_id'))->latest()->get();
        $deal_wallet=Business::where('id', session('business_id'))->select('deal_wallet')->first();

        return view('deals.index')
            ->with('deals', $deals)
            ->with('deal_wallet', $deal_wallet);

    }
    public function freeDeal()
    {

        $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();
        $state = DB::table('states')->get();
        $business = Business::where('id', '=', session('business_id'))->first();
        $subPrice = DB::table('states')->where('id', '=', $business->state_province)->first();

        return view('deals.freeDeal', [
            'products' => $products,
            'state' => $state,
            'subPrice' => $subPrice,
        ]);

    }
    public function create() {

        $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();
        $state = DB::table('states')->get();
        $business= Business::where('id','=',session('business_id'))->first();
        $subPrice = DB::table('states')->where('id','=',$business->state_province)->first();

        return view('deals.create', [
            'products' => $products,
            'state'=> $state,
            'subPrice' => $subPrice,
        ]);


    }
    public function free(Request $request)
    {

        $validated = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'state_id' => 'required',
            'deal_price' => 'required|numeric|min:1',
        ]);


        if (!is_null($request->product_id) && !is_null($request->product_id_2)) {
            if ($request->product_id == $request->product_id_2) {
                return redirect()->back()->with('error', 'Deal products must be different');
            }
        }

        $price = $request->deal_price;
        $ending_date = \Illuminate\Support\Carbon::now()->addDays(14)->format('Y-m-d');

        $starting_date = Carbon::now()->format('Y-m-d');
        $dealId = NULL;
        $getbusiness = Business::where('id', session('business_id'))->first();
        if($getbusiness->deal_wallet >0){

        }else{
            return redirect()->back()->with('error', 'Sorry something went wrong');
        }

        try {

            $deal = new Deal;

            $deal->retailer_id = session('business_id');
            $deal->title = $request->title;

            $picturePaths = [];

            if ($request->hasFile('picture')) {

                $avatars = $request->file('picture');

                foreach ($avatars as $avatar) {
                    $filename = time() . '.' . $avatar->GetClientOriginalExtension();

                    $avatar_img = \Intervention\Image\Facades\Image::make($avatar);
                    $avatar_img->resize(373, 373)->save(public_path('images/deals/' . $filename));

                    $dealPicture = asset("images/deals/" . $filename);
                    array_push($picturePaths, $dealPicture);
                }

            }

            $deal->picture = json_encode($picturePaths);
            $deal->coupon_code = $request->coupon_code;
            $deal->percentage = $request->percentage;
            $deal->deal_price = $validated['deal_price'];
            $deal->starting_date = $starting_date;
            $deal->ending_date = $ending_date;
            $deal->description = $request->description;
            $deal->is_paid = 1;
            $deal->save();



            if ($request->product_id) {
                DealProduct::create([
                    'deal_id' => $deal->id,
                    'product_id' => $request->product_id
                ]);
            }

            if ($request->product_id_2) {
                DealProduct::create([
                    'deal_id' => $deal->id,
                    'product_id' => $request->product_id_2
                ]);
            }




            if($getbusiness->deal_wallet >0){
                $business = DB::table('businesses')->where('id', session('business_id'))->update([
                    'deal_wallet' => $getbusiness->deal_wallet-1
                ]);
            }

            return redirect()->back()->with('info', 'Deal created.');



        } catch (Exception $e) {

            if (!is_null($dealId)) {
                $deal = Deal::where('id', $dealId)->first();

                DealProduct::where('deal_id', $dealId)->delete();

                if (!is_null($deal)) {

                    $dealPicture = $deal->picture;
                    $dealDeleted = $deal->delete();

                    if ($dealDeleted) {
                        if ($dealPicture) {
                            $dealPicture = json_decode($dealPicture);

                            if ($dealPicture) {
                                foreach ($dealPicture as $pic) {
                                    $exp = explode('/', $pic);
                                    $expImage = $exp[count($exp) - 1];

                                    if (File::exists(public_path('images/deals/' . $expImage))) {
                                        File::delete(public_path('images/deals/' . $expImage));
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return redirect()->back()->with('error', 'Sorry something went wrong');
        }

    }
    public function save(Request $request) {

        $validated = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'deal_price' => 'required|numeric|min:1',
            'price'=>'required|numeric|min:1',
            'name_on_card' => 'required|min:2',
            'cvv' => 'required|numeric|digits:3',
            'card_number' => 'required|numeric|digits:16',
            'expiration_month' => 'required',
            'expiration_year' => 'required'
        ]);

        if(!is_null($request->product_id) && !is_null($request->product_id_2)) {
            if($request->product_id == $request->product_id_2) {
                return redirect()->back()->with('error', 'Deal products must be different');
            }
        }

//            $tiers = [1, 2, 3];
//            $price = 0;
//            $ending_date = "";
//
//            if(!in_array($validated['tier_id'], $tiers)) {
//                return back();
//            }
//
//            if($validated['tier_id'] == 1) {
//
//                $ending_date = Carbon::now()->addDays(7)->format('Y-m-d');
//                $price = 50.00;
//
//            } elseif($validated['tier_id'] == 2) {
//
//                $ending_date = Carbon::now()->addDays(14)->format('Y-m-d');
//                $price = 80.00;
//
//            } elseif($validated['tier_id'] == 3) {
//
//                $ending_date = Carbon::now()->addDays(30)->format('Y-m-d');
//                $price = 140.00;
//
//            }
        $price = $request->price;
        $ending_date = Carbon::now()->addDays(14)->format('Y-m-d');
            $starting_date = Carbon::now()->format('Y-m-d');

            $dealId = NULL;
            $dealOrderId = NULL;

            try {

                $authorizePayment = resolve(AuthorizeService::class);
                $response = $authorizePayment->chargeCreditCard($validated, $price);
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {

                $deal = new Deal;

                $deal->retailer_id = session('business_id');
                $deal->title = $request->title;

                $picturePaths = [];

                if($request->hasFile('picture')) {

                    $avatars = $request->file('picture');

                    foreach($avatars as $avatar) {
                        $filename = time() . '.' . $avatar->GetClientOriginalExtension();

                        $avatar_img = Image::make($avatar);
                        $avatar_img->resize(373,373)->save(public_path('images/deals/' . $filename));

                        $dealPicture = asset("images/deals/" . $filename);
                        array_push($picturePaths, $dealPicture);
                    }

                }

                $deal->picture = json_encode($picturePaths);
                $deal->coupon_code = $request->coupon_code;
                $deal->percentage = $request->percentage;
                $deal->deal_price = $validated['deal_price'];
                $deal->starting_date = $starting_date;
                $deal->ending_date = $ending_date;
                $deal->description = $request->description;
                $deal->is_paid = 1;
                $deal->save();

                $dealId = $deal->id;

                $created = DealOrder::create([
                    'retailer_id' => session('business_id'),
                    'deal_id' => $deal->id,
                    'amount' => $price,
                    'name_on_card' => $validated['name_on_card'],
                    'response_code' => $tresponse->getResponseCode(),
                    'transaction_id' => $tresponse->getTransId(),
                    'auth_id' => $tresponse->getAuthCode(),
                    'message_code' => $tresponse->getMessages()[0]->getCode(),
                    'quantity' => 1,
                ]);


                $dealOrderId = $created->id;

                if($request->product_id) {
                    DealProduct::create([
                        'deal_id' => $deal->id,
                        'product_id' => $request->product_id
                    ]);
                }

                if($request->product_id_2) {
                    DealProduct::create([
                        'deal_id' => $deal->id,
                        'product_id' => $request->product_id_2
                    ]);
                }

                return redirect()->back()->with('info', 'Deal created.');

            } else {

                return redirect()->back()->with('error', 'Sorry we couldn\'t process the payment');

            }

            } catch(Exception $e) {

                if(!is_null($dealId)) {
                    $deal = Deal::where('id', $dealId)->first();

                    DealProduct::where('deal_id', $dealId)->delete();

                    if(!is_null($deal)) {

                        $dealPicture = $deal->picture;
                        $dealDeleted = $deal->delete();

                        if($dealDeleted) {
                            if($dealPicture) {
                                $dealPicture = json_decode($dealPicture);

                                if($dealPicture) {
                                    foreach($dealPicture as $pic) {
                                        $exp = explode('/', $pic);
                                        $expImage = $exp[count($exp) - 1];

                                        if(File::exists(public_path('images/deals/'.$expImage)))
                                        {
                                            File::delete(public_path('images/deals/'.$expImage));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if(!is_null($dealOrderId)) {
                    DealOrder::where('id', $dealOrderId)->delete();
                }

                return redirect()->back()->with('error', 'Sorry something went wrong');
            }
    }

    public function edit($id) {

        if(is_null($this->checkIfRetailerDeal($id))) {
            return redirect()->route('deals');
        }

        $deal = Deal::find($id);
        $dealProducts = DealProduct::where('deal_id', $id)->get();

        $dealProduct1 = $dealProducts->has(0) ? $dealProducts[0] : null;
        $dealProduct2 = $dealProducts->has(1) ? $dealProducts[1] : null;

        $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();

        return view('deals.edit')
            ->with('deal', $deal)
            ->with('dealProduct1', $dealProduct1)
            ->with('dealProduct2', $dealProduct2)
            ->with('products', $products);
    }

    public function update(Request $request) {

        if(is_null($this->checkIfRetailerDeal($request->deal_id))) {
            return redirect()->route('deals');
        }

        $deal = Deal::find($request->deal_id);

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deal_price' => 'required'
        ]);

        if(!is_null($request->product_id) && !is_null($request->product_id_2)) {
            if($request->product_id == $request->product_id_2) {
                return redirect()->back()->with('error', 'Deal products must be different');
            }
        }

        $deal->title = $validated['title'];

        $picturePaths = [];

        $avatars = [];

        $oldPictures = NULL;

        if($request->hasFile('picture')) {

            $avatars = $request->file('picture');
            $oldPictures = $deal->picture;

            foreach($avatars as $avatar) {
                $filename = time() . '.' . $avatar->GetClientOriginalExtension();

                $avatar_img = Image::make($avatar);
                $avatar_img->resize(373,373)->save(public_path('images/deals/' . $filename));

                $dealPicture = asset("images/deals/" . $filename);
                array_push($picturePaths, $dealPicture);
            }

        }

        if(count($avatars) > 0) {
            $deal->picture = json_encode($picturePaths);
        }

        $deal->deal_price = $validated['deal_price'];
        $deal->description = $validated['description'];

        $saved = $deal->save();

        if($saved) {
            if(!is_null($oldPictures)) {
                $oldPictures = json_decode($oldPictures);
                foreach($oldPictures as $pic) {
                    $exp = explode('/', $pic);
                    $expImage = $exp[count($exp) - 1];

                    if(File::exists(public_path('images/deals/'.$expImage))){
                        File::delete(public_path('images/deals/'.$expImage));
                    }
                }
            }
        }

        DealProduct::where('deal_id', $deal->id)->delete();

        if($request->product_id) {
            DealProduct::create([
                'deal_id' => $deal->id,
                'product_id' => $request->product_id
            ]);
        }

        if($request->product_id_2) {
            DealProduct::create([
                'deal_id' => $deal->id,
                'product_id' => $request->product_id_2
            ]);
        }

        return redirect()->back()->with('info', 'Deal updated.');

    }

    public function deletedeal($id) {

         if(is_null($this->checkIfRetailerDeal($id))) {
            return redirect()->route('deals');
         }

         $deal = Deal::find($id);

         $oldPictures = $deal->picture;

         $deleted = $deal->delete();

         if($deleted) {

            if($oldPictures) {
                $oldPictures = json_decode($oldPictures);
                foreach($oldPictures as $pic) {
                    $exp = explode('/', $pic);
                    $expImage = $exp[count($exp) - 1];

                    if(File::exists(public_path('images/deals/'.$expImage))){
                        File::delete(public_path('images/deals/'.$expImage));
                    }
                }
            }

            return redirect()->back()->with('info', 'Deal Deleted Successfully.');
         } else {
            return redirect()->back()->with('error', 'Sorry something went wrong.');
         }

    }

    /*
    *   CHECK IF RETAILER DEAL
    *
    */

    private function checkIfRetailerDeal($dealId) {
        $businessId = session('business_id');

        $deal = Deal::where([
            ['id', $dealId],
            ['retailer_id', $businessId]
        ])->first();

        return $deal;
    }
    public function subscription()
    {
        $state = DB::table('states')->get();
        $business= Business::where('id','=',session('business_id'))->first();
        $subPrice = DB::table('states')->where('id','=',$business->state_province)->first();
        return view('subscription.index', [
            'state' => $state,
            'business'=>$business,
            'subPrice'=>$subPrice
        ]);
    }

    public function getSubscription(Request $request)
    {
        $state = DB::table('states')->where('id', '=', $request->id)->first();
        return response()->json(['success' => $state]);

    }

    public function storeSubscription(Request $request)
    {

        $validated = request()->validate([

            'state_id' => 'required',
            'price' => 'required',
            'name_on_card' => 'required|min:2',
            'cvv' => 'required|numeric|digits:3',
            'card_number' => 'required|numeric|digits:16',
            'expiration_month' => 'required',
            'expiration_year' => 'required'
        ]);


        $starting_date = \Illuminate\Support\Carbon::now()->format('Y-m-d');
        $price = $request->price;

        $authorizePayment = resolve(AuthorizeService::class);
        $response = $authorizePayment->chargeCreditCard($validated, $price);
        $tresponse = $response->getTransactionResponse();

        if ($tresponse != null && $tresponse->getMessages() != null) {

            DB::table('subscription_details')->insert(
                ['retailer_id' => session('business_id'),
                    'state_id' => $request->state_id,
                    'price' => $request->price,
                    'name_on_card' => $request->name_on_card,
                    'response_code' => $tresponse->getResponseCode(),
                    'transaction_id' => $tresponse->getTransId(),
                    'auth_id' => $tresponse->getAuthCode(),
                    'message_code' => $tresponse->getMessages()[0]->getCode(),
                    'type' => 'Deliveries',
                    'starting_date' => $starting_date,
                    'ending_date' => Carbon::now()->addDays(30)->format('Y-m-d'),

                ]
            );
            $getbusiness = Business::where('id', session('business_id'))->first();
            DB::table('businesses')->where('id', session('business_id'))->update([
                'deal_wallet' => $getbusiness->deal_wallet+2
            ]);

            return redirect()->back()->with('info', 'Deal created.');

        } else {

            return redirect()->back()->with('error', 'Sorry we couldn\'t process the payment');

        }


    }

    public function stateArea()
    {
        $business = Business::where('id', '=', session('business_id'))->first();

        $area = DB::table('areas')->where('state_id', '=', $business->state_province)->get();

        return view('marketing.main', compact('area', 'business'));
    }

    public function marketing($id)
    {
        $business = Business::where('id', '=', session('business_id'))->first();
        $area = DB::table('areas')->find($id);
        $position = DB::table('position_sets')->where('area_id','=',$id)->where('date','=', \Illuminate\Support\Carbon::now()->addMonth(1)->format('m, Y'))->pluck('position')->toArray();;

        return view('marketing.index', compact('business', 'area','position'));
//        $distance = DB::table('areas')->selectRaw("id,
//                         ( 3956   * acos( cos( radians(?) ) *
//                           cos( radians( latitude ) )
//                           * cos( radians( longitude ) - radians(?)
//                           ) + sin( radians(?) ) *
//                           sin( radians( latitude ) ) )
//                         ) AS distance", [$latitude, $longitude, $latitude])
//            ->having("distance", "<", $radius)
//            ->orderBy("distance", 'asc')
//            ->first();

    }

    public function bookMe($id,$price,$p)
    {
        $area = DB::table('areas')->find($id);
        return view('marketing.payment', compact('area','price','p'));

    }
    public function bannerPaymant(Request $request)
    {
        $id = request()->id;
        $validated = request()->validate([
            'price' => 'required',
            'name_on_card' => 'required|min:2',
            'cvv' => 'required|numeric|digits:3',
            'card_number' => 'required|numeric|digits:16',
            'expiration_month' => 'required',
            'expiration_year' => 'required'
        ]);


        $starting_date = Carbon::now()->addMonth(1)->format('y-m-01');
        $ending_date = Carbon::now()->addMonth(1)->format('Y-m-t');
        $price = $request->price;

        $authorizePayment = resolve(AuthorizeService::class);
        $response = $authorizePayment->chargeCreditCard($validated, $price);
        $tresponse = $response->getTransactionResponse();

        if ($tresponse != null && $tresponse->getMessages() != null) {

            $getid = DB::table('banner_paymants')->insertGetId(
                ['retailer_id' => session('business_id'),
                    'area_id' => $request->area_id,
                    'price' => $request->price,
                    'description' => $request->description,
                    'name_on_card' => $request->name_on_card,
                    'response_code' => $tresponse->getResponseCode(),
                    'transaction_id' => $tresponse->getTransId(),
                    'auth_id' => $tresponse->getAuthCode(),
                    'message_code' => $tresponse->getMessages()[0]->getCode(),
                    'starting_date' => $starting_date,
                    'ending_date' => $ending_date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                ]
            );
            DB::table('position_sets')->insert(
                [
                    'b_payment_id'=>$getid,
                    'area_id' => $request->area_id,
                    'position' => $request->position,
                    'date' => Carbon::now()->addMonth(1)->format('m, Y'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

//            return redirect()->back()->with('info', 'Position Booked.');
            return redirect()->route('marketing', ['id' => $id])->with('info', 'Position Booked.');

        } else {

            return redirect()->back()->with('error', 'Sorry we couldn\'t process the payment');

        }

    }
}
