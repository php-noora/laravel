<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Course = Part::with('course' , 'sessions')->get();
        return response()->json([
//            'status' => true,
//            'message' => 'successfully',
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
        $image=$course->addMediaFromRequest('img')->toMediaCollection();

        $course->update([
            'img'=>$image->getUrl()
        ]);


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


    public function sale()
    {
        /*$course=DB::table('courses')
            ->join('parts','courses.id','=','parts.course_id')
            ->where('course_type','!=','free')
            ->orderBy('sales_number','desc')
            ->get(['title','img','Description','parts.Number_session']);*/
        $datas = [];
        $courses = Course::with('parts')->where('course_type','!=','free')->get();
        foreach ($courses as $course){
            $image = $course->getMedia()->first()->getUrl();
            $data = [
                'data'=>$course,
                'image'=>$image
            ];
            $datas []= $data;
        }
        return response()->json([
            'status' => true,
            'data'=>$datas
        ]);
    }
    public function free()
    {
//        $course=DB::table('courses')
//            ->join('parts','courses.id','=','parts.course_id')
//            ->where('course_type','free')
//            ->get(['title','img','Description','parts.Number_session']);

        $datas = [];
        $courses= Course::with('parts')->where('course_type','free')->get();
        foreach ($courses as $course){
            $image = $course->getMedia()->first()->getUrl();
            $data = [
                'data'=>$course,
                'image'=>$image
            ];
            $datas []= $data;
        }
        return response()->json([
            'status' => true,
            'data'=>$datas
        ]);
    }


}


