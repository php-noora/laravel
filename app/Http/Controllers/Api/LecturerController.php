<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorelecturerRequest;
use App\Http\Requests\UpdatelecturerRequest;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = [];
        $lecturers = Lecturer::all();
        foreach ($lecturers as $lecturer) {
            $image = $lecturer->getMedia()->first()->getUrl();
            $data = [
                'data'=>$lecturer,
                'image'=>$image
            ];
            $datas []= $data;
        }
        return response()->json([
            'message' => 'successfully',
            'data' => $datas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelecturerRequest  $request)
    {
        $lecturer=Lecturer::create([

            'name' => $request->name,
            'cv' => $request->cv,
             ]);
        $lecturer->addMediaFromRequest('image')->toMediaCollection();

        return response()->json([
            'message' => 'lecturer created successfully',
            'data' => $lecturer
        ], 201);
     }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelecturerRequest  $request, $id)
    {
       // dd(141414);

        $lecturer = Lecturer ::where('id', $id)->update([
            'name' => $request->name,
            'cv' => $request->cv,
            'image' => $request->image
             ]);
        return response()->json([
            'status' => true,
            'message' => 'user updated successfully',
            'data' => Lecturer::find($id)
        ], 200);
    }

    //    public function edit($id)
//    {
//         $lecturer = Lecturer::find($id);
//        if (!$lecturer) {
//            return response()->json([
//                'status' => false,
//                'message' => 'lecturer not found'
//            ], 404);
//        }
//        return response()->json([
//            'status' => true,
//            'message' => 'lecturer retrieved successfully',
//            'data' => $users
//        ],);
//    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        Lecturer::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'lecturer delete successfully'
        ], 200);
    }

}
