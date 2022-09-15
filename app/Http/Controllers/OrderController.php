<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Business;
use App\Mail\OrderStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller {

    public function index() {

        $orders = Order::where('retailer_id', session('business_id'))
        ->groupBy('tracking_number')->latest()->paginate(20);

        Order::where('retailer_id', session('business_id'))->update([
            'read' => 0
        ]);

        return view('orders.index', [
            'orders' => $orders
        ]);

    }

    public function orderStatus(Request $request) {

        $validated = $request->validate([
            'order_id' => 'required',
            'status' => 'required'
        ]);

        $statuses = ['Accepted', 'Rejected', 'Completed'];

        if(!in_array($validated['status'], $statuses)) {
            return redirect()->back();
        }

        $order = Order::where('id', $validated['order_id'])->where('retailer_id', session('business_id'))->first();

        if(is_null($order))
        {
            return redirect()->back();
        }

        $updated = Order::where('tracking_number', $order->tracking_number)->where('retailer_id', session('business_id'))->update(['status' => $validated['status']]);

        if($order->status != $validated['status']) {

            $businessType = Business::where('id', $order->retailer_id)->pluck('business_type')->first();

            Mail::to($order->customer_email)->send(new OrderStatus($order->tracking_number, $businessType, $validated['status']));
        }

        if($updated) {
            if($order->product_id != null){
                $product = DB::table('delivery_products')->where('id', $order->product_id)->first();
                $name = $product->name;
                $image = $product->image ?? null;
                $product = 'delivery product';
            }else{
                $deal = DB::table('deals')->where('id', $order->deal_id)->first();
                $name = $deal->title;
                $image = json_decode($deal->picture);
                $product = 'delivery deal';
            }


            $notification = DB::table('notifications')->insert([
                'title'=>$order->qty.' '.$name .' Delivery',
                'description'=>'Your order of delivery has been '.$validated['status'],
                'path'=>'/profile/order-history/'.$order->tracking_number,
                'image'=>$image[0],
                'customer_id'=>$order->customer_id,
                'type_id'=>$order->product_id,
                'noti_type'=>$product,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
            return back()->with('success', 'Order status is changed');
        } else {
            return back()->with('error', 'Sorry Something went wrong');
        }
    }

    public function orderRating(Request $request) {

        $validated = $request->validate([
            'order_id' => 'required',
            'rating' => 'required'
        ]);

        $updated = Order::where('id', $validated['order_id'])->update(['rating' => $validated['rating']]);
        if($updated) {
            return back()->with('success', 'Review is added');
        } else {
            return back()->with('error', 'Sorry something went wrong');
        }
    }

}
