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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        $banner=Banner::create([
            'title'=>$request->title,
            'image'=>$request->image,
        ]);
        $banner->addMediaFromRequest('image')->toMediaCollection();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, $id)
    {

        $banner=Banner::find($id);
        $banner->update([
            'title'=>$request->title,
        ]);
        if ($request->hasFile('image')) {
            $banner->media()->delete();
            $banner->addMediaFromRequest('image')->toMediaCollection();
        }
        return response()->json([
            'status' => true,
            'message' => ' updated successfully',
            'data' => Banner::find($id)
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
