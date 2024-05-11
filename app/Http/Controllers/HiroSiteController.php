<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\HiroSite;
use App\Http\Requests\StoreHiroSiteRequest;
use App\Http\Requests\UpdateHiroSiteRequest;

class HiroSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHiroSiteRequest $request)
    {
        $heroes=HiroSite::create([
            'Site_slogan'=>$request->Site_slogan,
        ]);
        $images=$heroes->addMediaFromRequest('image')->toMediaCollection();
        $heroes->update([
            'image'=>$images->getUrl(),
        ]);
        return response()->json([
            'status'=>'sucsess',
            'hero'=>$heroes,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(HiroSite $hiroSite, $id)
    {
        $hiroSite=HiroSite::find($id);
        return response()->json([
            'status'=>'success',
            'hero'=>$hiroSite
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HiroSite $hiroSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHiroSiteRequest $request, HiroSite $hiroSite,$id)
    {
        $banner=HiroSite::find($id);
        $banner->update([
            'Site_slogan'=>$request->Site_slogan,
        ]);
        if ($request->hasFile('image')) {
            $banner->media()->delete();
            $image= $banner->addMediaFromRequest('image')->toMediaCollection();
            $banner->update([
                'image'=>$image->getUrl()
            ]);

        }
        return response()->json([
            'status' => true,
            'data' => $banner,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HiroSite $hiroSite)
    {
        //
    }
}
