<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;
use App\Models\Part;
use App\Models\Session;

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
        try {
            $part= Part::create([

            'name' => $request->name,
                'Number_session'=>count($part['session_data']),
            'course_id' => $request->course_id,

        ]);

            foreach ($part['session_data'] as $session)
            {
                Session::create([
                    'name'=>$session['name'],
                    'Duration_course'=>$session['Duration_course'],
                    'video'=>$session['video'],
                    'part_id'=>$part->id
                ]);


        }
        return response()->json([
            'message' => 'Data saved successfully'
        ], 200);

    } catch (Exception $e) {

        return response()->json([
            'message' => 'created successfully',
        ], 201);
    }
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
            'Number_session'=>$request->Number_session,
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
