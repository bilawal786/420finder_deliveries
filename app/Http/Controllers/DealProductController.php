<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\DealProduct;
use App\Models\DeliveryProducts;
use Illuminate\Http\Request;

class DealProductController extends Controller
{
    /*
    *  RETURN ALL DEALS PRODUCTS
    *
    */
    public function index()
    {
        $deals = Deal::where('retailer_id', session('business_id'))
              ->join('deal_products', 'deal_products.deal_id', '=', 'deals.id')
              ->get();

        $deals = $deals->groupBy('deal_id');

        return view('deal-products.index', [
            'deals' => $deals
        ]);
    }


    /*
    *  ADD PRODUCT TO DEAL
    *
    */

    public function add() {
        $deals = Deal::where('retailer_id', session('business_id'))->get();
        $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();

        return view('deal-products.add', [
            'deals' => $deals,
            'products' => $products
        ]);

    }

    /*
    *   STORE DEAL PRODUCT
    *
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'deal' => 'required',
            'product' => 'required'
        ]);

       $dealId = $validated['deal'];
       $productId = $validated['product'];

       if($this->checkIfDealProductExist($dealId, $productId))
       {
            $created = DealProduct::create([
                'deal_id' => $dealId,
                'product_id' => $productId
            ]);
            if($created) {
                return redirect()->route('deal-product.index')->with('success', 'Product added to deal');
            } else {
                return back()->with('error', 'Sorry something went wrong');
            }

       } else {
            return back()->with('success', 'Product already in deal');
       }
    }

    /*
    *  SHOW SINGLE DEAL EDIT PAGE
    *
    */
    public function edit($dealId)
    {
        if($this->checkIfUserDeal($dealId)) {
            $deals = DealProduct::where('deal_id', $dealId)
              ->join('deals', 'deal_products.deal_id', '=', 'deals.id')
              ->get();

            return view('deal-products.edit', [
                'deals' => $deals
            ]);

        } else {
            return redirect()->route('deal-product.index');
        }
    }

    /*
    *  REMOVE DEAL PRODUCT
    *
    */
    public function delete($dealId, $productId)
    {
        if($this->checkIfUserDeal($dealId)) {

            $deleted = DealProduct::where([
            ['deal_id', $dealId],
            ['product_id', $productId]
            ])->delete();

            if($deleted) {
                return back()->with('success', 'Product removed successfully!');
            } else {
                return back()->with('error', 'Sorry something went wrong');
            }
        } else {
            return redirect()->route('deal-product.index');
        }
    }

    /*
    *   CHECK IF USER DEAL
    *
    */
    private function checkIfUserDeal($dealId) {
        $deal = Deal::where('id', $dealId)
              ->where('retailer_id', session('business_id'))
              ->first();

        if(!is_null($deal)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    *   CHECK IF DEAL PRODUCT ALREADY EXIST
    *
    */

    private function checkIfDealProductExist($dealId, $productId)
    {
        $dealProduct = DealProduct::where([
            ['deal_id', $dealId],
            ['product_id', $productId]
        ])->first();

        if(is_null($dealProduct)) {
            return true;
        } else {
            return false;
        }
    }
}
