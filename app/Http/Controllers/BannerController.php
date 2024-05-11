<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $datas=[];
        $banners=Banner::all();
        foreach($banners as $banner){
//            $image =$banner->getMedia()->first()->getUrl();
            $image =$banner->getMedia()->first()->getUrl();

            $data =[
                'data'=>$banners,
                'image'=>$image,
            ];

        }

        return response([
            'banner'=>$image,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        $banner=Banner::create($request->all());
        $image=$banner->addMediaFromRequest('image')->toMediaCollection();
        $banner->update([
            'image'=>$image->getUrl()
        ]);

        return response()->json([
            'status'=>'true',
            'message'=>'create Baanner is successfully',
        ],201);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner1=Banner::find(10);
        return response([
            'status'=>'true',
            'banner'=>$banner1,
        ]);

//        $banner2=Banner::find(2);
//        return response([
//            'status'=>'true',
//            'banner'=>$banner2,
//        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, $id)
    {

        $banner=Banner::find($id);
        if ($request->hasFile('image')) {
            $banner->media()->delete();
           $image= $banner->addMediaFromRequest('image')->toMediaCollection();
            $banner->update([
                'image'=>$image->getUrl()
            ]);

        }
        return response()->json([
            'status' => true,
            'message' => 'banner updated successfully',
            'data' => $banner,
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
