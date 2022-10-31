<?php

use App\Http\Controllers\ApproveController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/redirect-to-delivery/{id}', function ($id) {
    $business = \App\Models\Business::find($id);
    \Illuminate\Support\Facades\Session::put('business_id', $id);
    \Illuminate\Support\Facades\Session::put('business_name', $business->name);
    \Illuminate\Support\Facades\Session::put('business_type', $business->type);
    \Illuminate\Support\Facades\Session::put('business_email', $business->email);
    return redirect()->route('index');
});
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', [
        'uses' => 'AdminController@login',
        'as' => 'login'
    ]);
    Route::post('/check-login', [
        'uses' => 'AdminController@checkLogin',
        'as' => 'checkLogin'
    ]);
});
Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['checkIfAuthenticated']], function () {
    Route::get('/logoutadmin', [
        'uses' => 'AdminController@logoutadmin',
        'as' => 'logoutadmin'
    ]);
});
Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['checkIfAuthenticated', 'checkIfApproved']], function () {
    Route::get('/index', [
        'uses' => 'AdminController@index',
        'as' => 'index'
    ]);
    Route::get('/products', [
        'uses' => 'ProductController@index',
        'as' => 'products'
    ]);
    Route::get('/product/edit/{id}', [
        'uses' => 'ProductController@editproduct',
        'as' => 'editproduct'
    ]);
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product', 'ProductController@store')->name('product.store');
    Route::delete('/product/{id}', 'ProductController@destroy')->name('product.destroy');
    Route::post('/product/payment', 'ProductController@storeRetailerPayment')->name('storeretailerpayment');
    // Transactions
    Route::get('/transactions', 'TransactionController')->name('transaction.index');
    // AJAX CALL
    Route::post('/gettypesubcat', 'ProductController@gettypesubcat')->name('gettypesubcat');
    Route::post('/getparentchildsc', [
        'uses' => 'ProductController@getparentchildsc',
        'as' => 'getparentchildsc'
    ]);
    Route::resource('gallery', 'GalleryController');
    Route::post('update-timezone', 'AccountController@timezone')->name('update-timezone');
    Route::get('/account-settings', [
        'uses' => 'AccountController@index',
        'as' => 'accountsettings'
    ]);
    Route::post('/updateState', [
        'uses' => 'AccountController@updateState',
        'as' => 'updateState'
    ]);
    Route::post('/savefirstname', [
        'uses' => 'AccountController@savefirstname',
        'as' => 'savefirstname'
    ]);
    Route::post('/savelastname', [
        'uses' => 'AccountController@savelastname',
        'as' => 'savelastname'
    ]);
    Route::post('/updateemail', [
        'uses' => 'AccountController@updateEmail',
        'as' => 'update-email'
    ]);
    Route::post('/updatebusinessphone', [
        'uses' => 'AccountController@updateBusinessPhone',
        'as' => 'update-business-phone'
    ]);
    Route::post('/savephonenumber', [
        'uses' => 'AccountController@savephonenumber',
        'as' => 'savephonenumber'
    ]);
    Route::post('/updatebusinessname', [
        'uses' => 'AccountController@updatebusinessname',
        'as' => 'updatebusinessname'
    ]);
    Route::post('/updateaddressone', [
        'uses' => 'AccountController@updateaddressone',
        'as' => 'updateaddressone'
    ]);
    Route::post('/updateaddresstwo', [
        'uses' => 'AccountController@updateaddresstwo',
        'as' => 'updateaddresstwo'
    ]);
    Route::post('/updatewebsiteurl', [
        'uses' => 'AccountController@updatewebsiteurl',
        'as' => 'updatewebsiteurl'
    ]);
    Route::post('/updateinstagramurl', [
        'uses' => 'AccountController@updateinstagramurl',
        'as' => 'updateinstagramurl'
    ]);
    Route::get('product/filter/{id}', 'ProductController@filters')->name('product.filter');
    Route::get('/request-products', [
        'uses' => 'ProductController@productrequests',
        'as' => 'requestproducts'
    ]);
    // Ajax Call
    Route::post('/getrproducts', [
        'uses' => 'ProductController@getrproducts',
        'as' => 'getrproducts'
    ]);
    Route::post('/submitproductrequest', [
        'uses' => 'ProductController@submitproductrequest',
        'as' => 'submitproductrequest'
    ]);
    Route::get('/products/gallery/delete/{id}', [
        'uses' => 'ProductController@removegalleryimage',
        'as' => 'removegalleryimage'
    ]);
    Route::post('/products/update', [
        'uses' => 'ProductController@updateproduct',
        'as' => 'updateproduct'
    ]);
    Route::get('/orders', [
        'uses' => 'OrderController@index',
        'as' => 'orders'
    ]);
    Route::post('/order/status', [
        'uses' => 'OrderController@orderStatus',
        'as' => 'order.status'
    ]);
    Route::post('/order/rating', [
        'uses' => 'OrderController@orderRating',
        'as' => 'order.rating'
    ]);
    Route::get('/other-store-locations', [
        'uses' => 'AccountController@otherlocations',
        'as' => 'otherlocations'
    ]);
    Route::post('/other-store-locations/storelocation', [
        'uses' => 'AccountController@storelocation',
        'as' => 'storelocation'
    ]);
    Route::get('/other-store-locations/delete/{id}', [
        'uses' => 'AccountController@deletelocation',
        'as' => 'deletelocation'
    ]);
    Route::post('/account-settings/profile/update', [
        'uses' => 'AccountController@updateprofilepicture',
        'as' => 'updateprofilepicture'
    ]);
    Route::post('/account-settings/profile/update/order-method', [
        'uses' => 'AccountController@updateordermethod',
        'as' => 'updateordermethod'
    ]);
    Route::get('/seo', 'AccountController@seo')->name('seo');
    Route::post('/update/seo', 'AccountController@seoUpdate')->name('update.seo');
    Route::post('ad/strain', 'AccountController@addStrain')->name('add.strain');
    Route::post('/account-settings/profile/update/opening-time', [
        'uses' => 'AccountController@updateopeningtime',
        'as' => 'updateopeningtime'
    ]);
    Route::post('/account-settings/profile/update/closing-time', [
        'uses' => 'AccountController@updateclosingtime',
        'as' => 'updateclosingtime'
    ]);
    Route::post('/account-settings/profile/update/coordinates', [
        'uses' => 'AccountController@savebcoordinates',
        'as' => 'savebcoordinates'
    ]);
    Route::get('/deals', [
        'uses' => 'DealsController@index',
        'as' => 'deals'
    ]);
    Route::get('/deals/create', [
        'uses' => 'DealsController@create',
        'as' => 'addnewdeal'
    ]);
    Route::get('/deals/free/deal', [
        'uses' => 'DealsController@freeDeal',
        'as' => 'freeDeal'
    ]);
    Route::post('/deals/free/save', [
        'uses' => 'DealsController@free',
        'as' => 'freeDealsave'
    ]);
    Route::post('/deals/save', [
        'uses' => 'DealsController@save',
        'as' => 'savedeal'
    ]);
    Route::get('/deals/delete/{id}', [
        'uses' => 'DealsController@deletedeal',
        'as' => 'deletedeal'
    ]);
    Route::get('/deals/edit/{id}', [
        'uses' => 'DealsController@edit',
        'as' => 'editdeal'
    ]);
    Route::post('/deals/update', [
        'uses' => 'DealsController@update',
        'as' => 'updatedeal'
    ]);
    // DEALS PRODUCT
    // Route::get('/deals/products', [
    //     'uses' => 'DealProductController@index',
    //     'as' => 'deal-product.index'
    // ]);
    // Route::get('/deals/products/add', [
    //     'uses' => 'DealProductController@add',
    //     'as' => 'deal-product.add'
    // ]);
    // Route::post('/deals/products/store', [
    //     'uses' => 'DealProductController@store',
    //     'as' => 'deal-product.store'
    // ]);
    // Route::get('/deals/products/{dealId}', [
    //     'uses' => 'DealProductController@edit',
    //     'as' => 'deal-product.edit'
    // ]);
    // Route::delete('/deals/products/delete/{dealId}/{productId}', [
    //     'uses' => 'DealProductController@delete',
    //     'as' => 'deal-product.delete'
    // ]);
    // DETAIL CONTROLLER
    Route::resource('/detail', 'DetailController');
    Route::get('/subscription', [
        'uses' => 'DealsController@subscription',
        'as' => 'subscription'
    ]);
    Route::post('/get/subscription', [
        'uses' => 'DealsController@getSubscription',
        'as' => 'get.subscription'
    ]);
    Route::post('/subscription/store', [
        'uses' => 'DealsController@storeSubscription',
        'as' => 'subscription.store'
    ]);
    Route::get('/marketing/{id}', [
        'uses' => 'DealsController@marketing',
        'as' => 'marketing'
    ]);
    Route::get('/state/areas', [
        'uses' => 'DealsController@stateArea',
        'as' => 'state.areas'
    ]);
    Route::get('/bookme/{id}/{price}/{p}', [
        'uses' => 'DealsController@bookMe',
        'as' => 'bookme'
    ]);
    Route::post('/banner/payment', [
        'uses' => 'DealsController@bannerPaymant',
        'as' => 'banner.payment'
    ]);

});

Route::group(['middleware' => ['checkIfAuthenticated']], function () {
    Route::get('/approve/failed', [ApproveController::class, 'approveFailed'])->name('approve.failed');
});
