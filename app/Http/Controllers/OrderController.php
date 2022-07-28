<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Business;
use App\Mail\OrderStatus;
use Illuminate\Http\Request;
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
