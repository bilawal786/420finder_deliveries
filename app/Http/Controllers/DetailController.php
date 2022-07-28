<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Mockery\Undefined;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $detail = Detail::where('business_id', session('business_id'))->first();

        return view('detail.index')->with('detail', $detail);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $deliveryDetail = Detail::where('business_id', session('business_id'))->first();

        // $amenities = [
        //     'brand_verified' => ($request->has('brand_verified')) ? $request->brand_verified : 'off',
        //     'access' => ($request->has('access')) ? $request->access : 'off',
        //     'security' => ($request->has('security')) ? $request->security : 'off',
        // ];

        if(is_null($deliveryDetail)) {
           $created = Detail::create([
                'business_id' => session('business_id'),
                'introduction' => $request->introduction,
                'about' => $request->about,
                // 'amenities' => json_encode($amenities),
                'amenities' => NULL,
                'customers' => $request->customers,
                'announcement' => $request->announcement,
                'license' => $request->license,
           ]);

            if($created) {
                return back()->with(
                    [ 'info' => 'Detail created Successfully.' ],
                    [ 'detail' => $created]
                );
            } else {
                return back()->with(
                    [ 'error' => 'Sorry something went wrong.' ],
                );
            }
        } else {
            $updated = $deliveryDetail->update([
                'introduction' => $request->introduction,
                'about' => $request->about,
                // 'amenities' => json_encode($amenities),
                'amenities' => NULL,
                'customers' => $request->customers,
                'announcement' => $request->announcement,
                'license' => $request->license,
            ]);

            if($updated) {
                return back()->with(
                    [ 'info' => 'Detail Updated Successfully.' ],
                    [ 'detail' => $updated]
                );
            } else {
                return back()->with(
                    [ 'error' => 'Sorry Something Went Wrong.'],
                    [ 'detail' => $deliveryDetail]
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
