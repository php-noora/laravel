<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;
use App\Models\Part;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Course = Part::all();
        return response()->json([
            'status' => true,
            'message' => 'successfully',
            'data' =>  $Course,
        ]);
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
    public function store(StorePartRequest $request)
    {
        Part::create([
            'name' => $request->name,
            'Number_videos'=>$request->Number_videos,
            'course_id' => $request->course_id,

        ]);
        return response()->json([
            'message' => 'created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Part $part)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Part $part)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartRequest $request, $id)
    {

        $part = Part::where('id', $id)->update([
            'name' => $request->name,
            'Number_videos'=>$request->Number_videos,
            'course_id' => $request->course_id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'user updated successfully',
            'data' => $part
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Part::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Part delete successfully'
        ], 200);    }
}
