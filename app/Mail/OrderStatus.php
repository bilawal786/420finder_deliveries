<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $trackingNumber;
    protected $businessType;
    protected $status;

    public function __construct($trackingNumber, $businessType, $status)
    {
        $this->trackingNumber = $trackingNumber;
        $this->businessType = $businessType;
        $this->status = $status;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $products = "";

        $orderInfo = Order::where('tracking_number', $this->trackingNumber)->first();

        if($this->businessType == 'delivery') {
           $products = Order::where('tracking_number', $this->trackingNumber)
            ->whereNotNull('product_id')
            ->join('delivery_products', 'delivery_products.id', 'orders.product_id')
            ->get();
        } else {
            $products = Order::where('tracking_number', $this->trackingNumber)
            ->whereNotNull('product_id')
            ->join('dispensery_products', 'dispensery_products.id', 'orders.product_id')
            ->get();
        }

        $orderDeals = Order::where('tracking_number', $this->trackingNumber)
            ->whereNotNull('deal_id')
            ->join('deals', 'deals.id', '=', 'orders.deal_id')
            ->get();

        return $this->from('support@420finder.net', '420 Finder')
        ->subject('Order Confirmation Summary #' . $this->trackingNumber)
        ->view('emails.order-status')
        ->with('products', $products)
        ->with('orderDeals', $orderDeals)
        ->with('orderInfo', $orderInfo)
        ->with('orderStatus', $this->status)
        ->with('logo', asset('images/logo.png'));
    }
}
