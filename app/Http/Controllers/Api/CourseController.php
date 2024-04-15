<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Course = Course::with('media')->get();
        return response()->json([
            'status' => true,
            'message' => 'successfully',
            'data' => $Course,
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
    public function store(StoreCourseRequest $request)
    {
//        dd( 'teeeeeeeeeeeeeeeeeeeeest');

        $course= Course::create([
            'title' => $request->title,
            'Description' => $request->Description,
            'price' => $request->price,
            'time' => $request->time,
            'lecturer_id' => $request->lecturer_id,
            'category_course_id' => $request->category_course_id
        ]);
        $course->addMediaFromRequest('img')->toMediaCollection();

        return response()->json([
            'message' => 'created successfully',
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
//        $Course = Course::find($id);
//        if (!$Course) {
//            return response()->json([
//                'status' => false,
//                'message' => 'Course not found'
//            ], 404);
//        }
//        return response()->json([
//            'status' => true,
//            'message' => 'Course retrieved successfully',
//            'data' => $Course
//        ],);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        $Course = Course::where('id', $id)->get()->first();
        $Course->update([
            'title' => $request->title,
            'Description' => $request->Description,
            'price' => $request->price,
            'time' => $request->time,
            'lecturer_id' => $request->lecturer_id,
            'category_course_id' => $request->category_course_id

        ]);
        if ($request->hasFile('img')) {
            $Course->media()->delete();
            $Course->addMediaFromRequest('img')->toMediaCollection();
        }


        return response()->json([
            'status' => true,
            'message' => ' updated successfully',
            'data' => CategoryCourse::find($id)
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Course::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete successfully'
        ], 200);
    }


}


