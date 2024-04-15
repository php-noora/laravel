<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storecategory_courseRequest;
use App\Http\Requests\Updatecategory_courseRequest;
use App\Models\CategoryCourse;
use Illuminate\Http\Request;

class CategoryCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $CategoryCourse=CategoryCourse::with('media')->get() ;

        return response()->json([
            'status' => true,
            'message' => 'Products retrieved successfully',
            'data' => $CategoryCourse,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storecategory_courseRequest  $request)
    {
        $categorycourse = CategoryCourse::create([
            'name' => $request->name
        ]);
        $categorycourse->addMediaFromRequest('img')->toMediaCollection();

//        if(!$request->hasFile('image')) {
//            return response()->json(['upload_file_not_found'], 400);
//        }
//        $file = $request->file('image');
//        if(!$file->isValid()) {
//            return response()->json(['invalid_file_upload'], 400);
//        }
//        $path = public_path() . '/uploads/images/store/';
//        $file->move($path, $file->getClientOriginalName());
//        return response()->json(compact('path'));


//        $fileName="user_image";
//         $path=$request->file( 'img')->move(public_path( "/"),$fileName );
//          $photoURl= url( '/'.$fileName );
//           return  response( )->json(['url' => $photoURl],200);

        return response()->json([
            'message' => 'user created successfully',
            'data' => $categorycourse
        ], 201);
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatecategory_courseRequest $request, $id)
    {
        //$categorycourse->update($request->validate());

        $categorycourse =CategoryCourse::where('id', $id)->get()->first();

        $categorycourse->update([
            'name' => $request->name,
       ]);
        if ($request->hasFile('img')) {
            $categorycourse->media()->delete();
            $categorycourse->addMediaFromRequest('img')->toMediaCollection();
        }

//        ]);
//            $category->media()->delete();
//        $category->addMedia('img')->toMediaCollection();



        //   $category =CategoryCourse::find($id);
     //   $category->addMediaFromRequest('image')->toMediaCollection();

        return response()->json([
            'status' => true,
            'message' => ' updated successfully',
            'data' => CategoryCourse::find($id)
        ], 200);    }


  //  public function edit($id)
  // {
 // $categorycourse=CategoryCourse::find($id);
//        if (!$categorycourse) {
//            return response()->json([
//                'status' => false,
//                'message' => 'user not found'
//            ], 404);
//        }
//        return response()->json([
//            'status' => true,
//            'message' => 'successfully',
//            'data' =>$categorycourse
//        ],);
  //}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CategoryCourse::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete successfully'
        ], 200);
    }
}
