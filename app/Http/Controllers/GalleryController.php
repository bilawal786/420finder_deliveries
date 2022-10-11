<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('business_galleries')->where('business_id', Session::get("business_id"))->get();
        return view('gallery.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $header_file = $request->filedata;
        $destinationPath = 'images/gallery/';
        $destinationfolder = '/images/gallery/';
        $header_originalFile = $header_file->getClientOriginalName();
        $header_filename = strtotime("now") . '-' . $header_originalFile;
        $avatar_img = \Intervention\Image\Facades\Image::make($header_file);
        $avatar_img->resize(373, 373)->save(public_path($destinationPath . $header_filename));
        $serve_url = URL::to('/');
        $header_img = $serve_url . $destinationfolder . $header_filename;
        DB::table('business_galleries')->insert([
            'business_id' => Session::get("business_id"),
            'image' => $header_img,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return response()->json($header_img);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('business_galleries')->find($id);
        return view('gallery.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = DB::table('business_galleries')->find($id);
        $serve_url = URL::to('/');
        $length = strlen($serve_url);
        $path = substr($image->image, $length + 1);
        File::delete($path);
        DB::table('business_galleries')->delete($id);
        return redirect()->route('gallery.index');
    }
}
