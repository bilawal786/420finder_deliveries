<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\DispenseryProduct;
use Exception;

use App\Models\Deal;

use App\Models\Brand;

use App\Models\Order;

use App\Models\Strain;

use App\Models\Genetic;

use App\Models\Category;

use App\Models\Favorite;
use App\Models\DealProduct;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\BrandProduct;
use App\Models\CategoryType;
use App\Models\DeliveryCart;
use Illuminate\Http\Request;
use App\Models\ProductRequest;
use App\Models\RecentlyViewed;
use App\Models\RetailerReview;
use App\Models\DeliveryProducts;
use App\Models\RetailerMenuOrder;
use App\Services\AuthorizeService;
use Illuminate\Support\Facades\DB;
use App\Models\BrandProductGallery;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\DeliveryProductGallery;

class ProductController extends Controller {

    public function index() {

        $products = DeliveryProducts::where('delivery_id', session('business_id'))->latest()->get();
        $paid = RetailerMenuOrder::where('retailer_id', session('business_id'))->first();
        return view('products.index')
            ->with('products', $products)
            ->with('paid', $paid);
    }

    public function productrequests() {

//        if(is_null($this->checkIfPaid())) {
//            return $this->redirectToPayment();
//        }

        $brands = Business::where('business_type', 'Brand')->where('approve', 1)->select('id', 'business_name')->get();

        $requests = ProductRequest::where('retailer_id', session('business_id'))->get();

        return view('requestproducts.index')
            ->with('brands', $brands)
            ->with('requests', $requests);

    }

    public function getrproducts(Request $request) {

        $brand_id = $request->brand_id;
        $bran = request()->brand;

        $products = BrandProduct::where('brand_id', $brand_id)
            ->select('id', 'name')
            ->get();

        $data = '
                    <option value="">Select</option>
                ';

        foreach($products as $product) {

            $checkbrand = DeliveryProducts::where('delivery_id', $bran)->where('brand_product_id', $product["id"])->get();

            if(count($checkbrand) == 0){
                $data .= '<option value="' . $product["id"] . '">' . $product["name"] . '</option>';
            }

        }

        echo $data;

    }

    public function submitproductrequest(Request $request) {

        $validated = $request->validate([
            'product_id' => 'required',
            'brand_id' => 'required'
        ]);

        $productIds = implode(", ", $request->product_id);

        $req = new ProductRequest;

        $req->retailer_id = session('business_id');

        $req->brand_id = $request->brand_id;

        $req->products = $productIds;

        $req->save();

        return redirect()->back()->with('info', 'Request Submitted.');

    }

    public function editproduct($id) {

//        if(is_null($this->checkIfPaid())) {
//            return $this->redirectToPayment();
//        }

        if(is_null($this->checkIfRetailerProduct($id))) {
            return redirect()->route('products');
        }

        $product = DeliveryProducts::where('id', $id)->first();

        if($product->brand_product) {
            return back();
        }

        $gallery = DeliveryProductGallery::where('delivery_product_id', $id)->get();

        $strains = Strain::all();
        $genetics = Genetic::all();

        return view('products.edit')
            ->with('product', $product)
            ->with('gallery', $gallery)
            ->with('strains', $strains)
            ->with('genetics', $genetics);

    }

    /*
    * GET CATEGORIES
    *
    */

    public function gettypesubcat(Request $request) {

        $category_id = $request->category_id;

        $types = CategoryType::where('category_id', $category_id)->get();

        $data = '

            <div class="row categoriesCols">
                ';
                foreach($types as $type) {
                    $data .='
                    <div class="col-md-3">
                        <h6 class="pb-2"><strong>' . $type->name . '</strong></h6>
                        <ul class="list-unstyled">';

                        $subcategories = SubCategory::where('type_id', $type->id)->where('parent_id', 0)->get();

                        foreach($subcategories as $subcat) {
                            $data .= '

                                <li class="mb-2"><label><input rel="' . $subcat->name . '" type="radio" class="childOfParentSC" name="type_' . $type->name . '" value="' . $subcat->id . '" required=""> ' . $subcat->name . '</label></li>

                            ';
                        }

                        $data .='</ul>
                    </div>';
                }
            $data .= "
                <script>

                    $('.childOfParentSC').on('click', function() {
                        var subcat_id = $(this).val();
                        var type_name = $(this).attr('rel');
                        var selected = $(this).attr('rel');
                        var main = $('.selectedcats').text();
                        $('#typesubcategories').addClass('loader');
                        $.ajax({
                            headers: {
                              'X-CSRF-TOKEN': '" . csrf_token() . "'
                            },
                            url:'" . route("getparentchildsc") . "',
                            method:'POST',
                            data:{subcat_id:subcat_id, type_name:type_name},
                            success:function(data) {
                                $('.subchild').remove();
                                $('.categoriesCols').append(data);

                                let str = main;
                                if(str.includes(selected)) {

                                } else {
                                    $('.selectedcats').html(main + selected + ', ');
                                }
                                $('#typesubcategories').removeClass('loader');
                            }
                        });

                    });

                </script>
            </div>
            ";

        $response = [
                        'statuscode'=> 200,
                        'data' => $data
                    ];

        echo json_encode($response);

    }

    /*
    *   GET PARENT CHILD
    *
    */
    public function getparentchildsc(Request $request) {

        $subcategories = SubCategory::where('parent_id', $request->subcat_id)->get();
        $data = '';

        if ($subcategories->count() > 0) {

            $data .='
                <div class="col-md-3 subchild">
                    <h6 class="pb-2"><strong>' . $request->type_name . ' Type</strong></h6>
                    <ul class="list-unstyled">';

                    foreach($subcategories as $subcat) {
                        $data .= '

                            <li class="mb-2"><label><input rel="' . $subcat->name . '" type="radio" class="childOfParentSC" name="type_' . $request->type_name . '" value="' . $subcat->id . '" required=""> ' . $subcat->name . '</label></li>

                        ';
                    }

                    $data .='</ul>
                </div>
                <script>
                    $(".childOfParentSC").on("click", function(){
                        var selected = $(this).attr("rel");
                        var main = $(".selectedcats").text();
                        let str = main;
                        if(str.includes(selected)) {
                            main.replace(selected+", ","");
                        } else {
                            $(".selectedcats").html(main + selected + ", ");
                        }
                    });
                </script>

                ';

            echo $data;

        }

    }


    /*
    *  CREATE PRODUCT
    *
    */

    public function create() {

//        if(is_null($this->checkIfPaid())) {
//            return $this->redirectToPayment();
//        }

        $categories = Category::all();

        $genetics = Genetic::all();

        $strains = Strain::all();

        return view('products.create')
            ->with('categories', $categories)
            ->with('genetics', $genetics)
            ->with('strains', $strains);
    }

    /*
    *   STORE PRODUCT
    *
    */

    public function store(Request $request) {
        $UUID = (string)Str::uuid();
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'sku' => 'required',
            'category_id' => 'required',
        ]);

        $product = new DeliveryProducts;
        $product->delivery_id = session('business_id');
        $product->name = $request->name;
        $product->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();
            $avatar_img = Image::make($avatar);
            $avatar_img->resize(274, 274)->save(public_path('images/brands/products/' . $filename));
            $product->image = asset("images/brands/products/" . $filename);
        }
        if (!$request->suggested_price){
            $product->flower_price_name = "yes";
            $product->fp1 = $request->fp1;
            $product->fp2 = $request->fp2;
            $product->fp3 = $request->fp3;
            $product->fp4 = $request->fp4;
            $product->fp5 = $request->fp5;
        }else{
            $product->price = $request->suggested_price;
        }
        $product->sku = $request->sku;
        $product->category_id = $request->category_id;
        $subcategoryids = NULL;
        $subcategorynames = NULL;
        $product->subcategory_ids = $subcategoryids;
        $product->subcategory_names = $subcategorynames;
        $product->strain_id = $request->strain_id;
        $product->genetic_id = $request->genetic_id;
        $product->thc_percentage = $request->thc_percentage;
        $product->cbd_percentage = $request->cbd_percentage;
        $product->brand_product = 0;
        $product->brand_product_id = 0;
        $product->brand_id = 0;
        if ($request->is_featured == 'on') {
            $product->is_featured = 1;
        } else {
            $product->is_featured = 0;
        }
        if ($product->save()) {
            return redirect()->route('products')->with('info', 'Product Created.');
        } else {
            return redirect()->route('products')->with('error', 'Problem occured while creating product.');
        }
    }

    /*
    *   DELETE PRODUCT
    *
    */

    public function destroy($deliveryProduct)
    {

//        if(is_null($this->checkIfPaid())) {
//            return $this->redirectToPayment();
//        }

        if(is_null($this->checkIfRetailerProduct($deliveryProduct))) {
            return redirect()->back();
        }

        $deliveryProductId = $deliveryProduct;

        // Initially Get Delivery Product Gallery Records
        $deliveryProductGallery = DeliveryProductGallery::where('delivery_product_id', $deliveryProduct)->get();

        $deliveryProductDB = DeliveryProducts::find($deliveryProduct);

        $oldImage = $deliveryProductDB->image;

        $deliveryProduct = $deliveryProductDB->delete();

        if($deliveryProduct) {

            // Orders
            Order::where('retailer_id', session('business_id'))->where('product_id', $deliveryProductId)->delete();

            // Recently Viewed
            RecentlyViewed::where('type', 'delivery')->where('product_id', $deliveryProductId)->delete();

            // Deals
            $deals = Deal::where('retailer_id', session('business_id'))->pluck('id')->toArray();

            // Deal Products
            DealProduct::whereIn('deal_id', $deals)->where('product_id', $deliveryProductId)->delete();

            // Delivery Carts
            DeliveryCart::where('business_id', session('business_id'))->where('product_id', $deliveryProductId)->delete();

            // Delivery Product Gallery
            if(!is_null($deliveryProductGallery)) {
                foreach($deliveryProductGallery as $image) {
                    $exp = explode('/', $image->image);
                    $expImage = $exp[count($exp) - 1];

                    if(File::exists(public_path('images/delivery/products/gallery/'.$expImage)))
                    {
                        File::delete(public_path('images/delivery/products/gallery/'.$expImage));
                    }
                }
            }

            DeliveryProductGallery::where('delivery_product_id', $deliveryProductId)->delete();


            // Favourites - Delivery Product

            Favorite::where('type_id', $deliveryProductId)->where('fav_type', 'Delivery Product')->delete();

            // Retailer Reviews
            RetailerReview::where('product_id', $deliveryProductId)->delete();

            if($oldImage) {
                $exp = explode('/', $oldImage);
                $expImage = $exp[count($exp) - 1];
                if(File::exists(public_path('images/brands/products/'.$expImage)))
                {
                    File::delete(public_path('images/brands/products/'.$expImage));
                }
            }

            return back()->with('info', 'Product Deleted.');

        } else {
            return back()->with('info', 'Sorry Something Went Wrong.');
        }

    }

    public function removegalleryimage($id) {

        $gimage = DeliveryProductGallery::find($id);

        if(is_null($this->checkIfRetailerProduct($gimage->delivery_product_id))) {
            return redirect()->back();
        }

        $oldImage = $gimage->image;

        $deleted = $gimage->delete();

        if($deleted) {

            if($oldImage) {
                $exp = explode('/', $oldImage);
                $expImage = $exp[count($exp) - 1];

                if(File::exists(public_path('images/delivery/products/gallery/'.$expImage)))
                {
                    File::delete(public_path('images/delivery/products/gallery/'.$expImage));
                }
            }

            return redirect()->back()->with('success', 'Gallery Image Deleted.');

        } else {

            return redirect()->back()->with('error', 'Sorry something went wrong.');
        }

    }

    public function updateproduct(Request $request) {

//        if(is_null($this->checkIfPaid())) {
//            return $this->redirectToPayment();
//        }

        $UUID = (string) Str::uuid();

        $validated = $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'sku' => 'required',
            'status' => 'required'
        ]);

        if(is_null($this->checkIfRetailerProduct($request->product_id))) {
            return redirect()->back();
        }

        $product = DeliveryProducts::find($request->product_id);

        $product->name = $request->name;

        $product->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

        $product->description = $request->description;

        $oldImage = NULL;
        if($request->hasFile('image')) {

            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->GetClientOriginalExtension();

            $avatar_img = Image::make($avatar);
            $avatar_img->resize(274,274)->save(public_path('images/brands/products/' . $filename));

            $oldImage = $product->image;
            $product->image = asset("images/brands/products/" . $filename);

        }

        $product->status = $request->status;
        $product->sku = $request->sku;
        $product->price = $request->price;
        // $product->off = $request->off;

        $product->off = 0;

        if ($request->is_featured == 'on') {

            $product->is_featured = 1;

        } else {

            $product->is_featured = 0;

        }

        $product->strain_id = $request->strain_id;
        $product->genetic_id = $request->genetic_id;
        $product->thc_percentage = $request->thc_percentage;
        $product->cbd_percentage = $request->cbd_percentage;

        if ($product->save()) {

            if(!is_null($oldImage)) {
                $exp = explode('/', $oldImage);
                $expImage = $exp[count($exp) - 1];

                if(File::exists(public_path('images/brands/products/'.$expImage)))
                {
                    File::delete(public_path('images/brands/products/'.$expImage));
                }
            }


            if ($request->hasFile('galleryimages')) {

                $deliveryGalleryImgs = DeliveryProductGallery::where('delivery_product_id', $request->product_id)->get();
                DeliveryProductGallery::where('delivery_product_id', $request->product_id)->delete();

                foreach($request->file('galleryimages') as $image) {

                    $name = $image->getClientOriginalName();
                    $name = $UUID . '-' . $name;
                    $image->move(public_path('images/delivery/products/gallery'), $name);

                    $bpg = new DeliveryProductGallery;

                    $bpg->delivery_product_id = $product->id;
                    $bpg->image = asset("images/delivery/products/gallery/" . $name);
                    $bpg->save();

                }

                // DELETE PREVIOUS GALLERY IMAGES
                if(!is_null($deliveryGalleryImgs)) {
                    foreach($deliveryGalleryImgs as $image) {
                        $exp = explode('/', $image->image);
                        $expImage = $exp[count($exp) - 1];

                        if(File::exists(public_path('images/delivery/products/gallery/'.$expImage)))
                        {
                            File::delete(public_path('images/delivery/products/gallery/'.$expImage));
                        }
                    }
                }

            }

            return redirect()->route('products')->with('info', 'Product Updated.');

        } else {

            return redirect()->route('products')->with('error', 'Problem occured while updated product.');

        }

    }


    /*
    *   STORE RETAILER PAYMENT
    *
    */
    public function storeRetailerPayment(Request $request) {

        $validated = request()->validate([
            'name_on_card' => 'required|min:2',
            'cvv' => 'required|numeric|digits:3',
            'card_number' => 'required|numeric|digits:16',
            'expiration_month' => 'required',
            'expiration_year' => 'required'
        ]);

        $createdId = NULL;
        try {

            $authorizePayment = resolve(AuthorizeService::class);
            $response = $authorizePayment->chargeCreditCard($validated);
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getMessages() != null) {

                $created = RetailerMenuOrder::create([
                    'retailer_id' => session('business_id'),
                    'amount' => '5.00',
                    'name_on_card' => $validated['name_on_card'],
                    'response_code' => $tresponse->getResponseCode(),
                    'transaction_id' => $tresponse->getTransId(),
                    'auth_id' => $tresponse->getAuthCode(),
                    'message_code' => $tresponse->getMessages()[0]->getCode(),
                    'quantity' => 1,
                ]);

                $createdId = $created->id;

                if($created) {

                    session()->flash('success', 'Your payment has been successful');

                    $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();

                    return view('products.index')
                        ->with('products', $products)
                        ->with('paid', $created);

                } else {

                    session()->flash('error', 'Sorry something went wrong');

                    $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();

                    return view('products.index')
                    ->with('products', $products)
                    ->with('paid', NULL);

                }

            } else {

                session()->flash('error', 'Sorry we couldn\'t process the payment');

                $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();

                return view('products.index')
                    ->with('products', $products)
                    ->with('paid', NULL);
            }

        } catch (Exception $e) {

            if(!is_null($createdId)) {
                RetailerMenuOrder::where('id', $createdId)->delete();
            }

            session()->flash('error', 'Sorry something went wrong');

            $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();

            return view('products.index')
                ->with('products', $products)
                ->with('paid', NULL);

        }

    }

    /*
    *   CHECK IF PAID
    *
    */

    private function checkIfPaid(){

        $retailerMenuOrder = RetailerMenuOrder::where('retailer_id', session('business_id'))->first();

        return $retailerMenuOrder;
    }

    /*
    *   REDIRECT TO PAYMENT
    *
    */
    private function redirectToPayment() {
        $products = DeliveryProducts::where('delivery_id', session('business_id'))->get();
        $paid = RetailerMenuOrder::where('retailer_id', session('business_id'))->first();
        return redirect()->route('products')
            ->with('products', $products)
            ->with('paid', $paid);
    }

    /*
    *   CHECK IF RETAILER PRODUCT
    *
    */
    private function checkIfRetailerProduct($productId) {
        $businessId = session('business_id');

        $product = DeliveryProducts::where([
            ['id', $productId],
            ['delivery_id', $businessId]
        ])->first();

        return $product;
    }
}
