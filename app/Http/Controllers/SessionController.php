<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session=Session::all();
        return Response()->json([
            'data'=>$session,
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
    public function store(StoreSessionRequest $request)
    {
//        dd($request->all());
        $session= Session::create([
            'name'=>$request->name,
            'Duration_course'=>$request->Duration_course,
            'part_id'=>$request->part_id,
        ]);
        $session->addMediaFromRequest('video')->toMediaCollection();
        return response()->json([
            'status'=>'sucsess_order',
            'order'=>$session,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSessionRequest $request,$id)
    {
        $session=Session::where('id', $id)->get()->first();
        $session->update([
            'name'=>$request->name,
            'Duration_course'=>$request->Duration_course,
            'part_id'=>$request->part_id,

        ]);
        if ($request->hasFile('video')) {
            $session->media()->delete();
            $session->addMediaFromRequest('video')->toMediaCollection();
        }
        return response()->json([
            'status' => true,
            'message' => ' updated successfully',
            'data' => $session,
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $session=Session::where('id', $id)->delete();
        return response()->json([
           'status'=>'true',
           'message'=>'delete successfully',
        ],200);

    }
}
