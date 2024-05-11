<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\CategoryCourse;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Part;
use App\Models\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $datas = [];
//        $courses = Part::with('course', 'session')->get();
        $courses = Part::with('course', 'sessions')->get();
        return response()->json([
            'status' => true,
            'data' => $courses

//        foreach ($courses as $course) {
//            $image = $course->getMedia()->first()->getUrl();
//            $data = [
//                'data' => $course,
//                'image' => $image
//            ];
//            $datas [] = $data;
//        }
//        return response()->json([
//            'status' => true,
//            'data' => $datas
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
    public function store(Request $request)
    {
//        dd($request->all());
        $lecture_id = Lecturer::where('id', $request->course['lecturer_id'])->first();
//        dd($request->course['part_data'][0]['name_part']);
        $category_course_id = CategoryCourse::where('id', $request->course['category_course_id'])->first();
//        dd($request->course['title']);
        try {
            $course = Course::create([
                'title' => $request->course['title'],
                'Description' => $request->course['Description'],
                'price' => $request->course['price'],
                'time' => $request->course['time'],
                'lecturer_id' => $lecture_id['id'],
                'category_course_id' => $category_course_id['id'],
            ]);
//        $image = $course->addMediaFromRequest('img')->toMediaCollection();
//       dd($image);
//        $course->update([
//            'img' => $image->getUrl()
//        ]);
//        dd($course);
//            dd($request->part_data);

            $parts = $request->course['part_data'];
            foreach ($parts as $part){
                $save_part=Part::create([
                   'name_part'=>$part['name_part'],
                    'Number_session'=>count($part['session_data']),
                    'course_id'=>$course->id
                ]);
                foreach ($part['session_data'] as $session)
                {
                    Session::create([
                        'name'=>$session['name'],
                        'Duration_course'=>$session['Duration_course'],
                        'video'=>$session['video'],
                        'part_id'=>$save_part->id
                        ]);
                }
            }

//            $sessions = $parts->sessions()->createMany([
//                'name' => $request->name,
//                'Duration_course' => $request->Duration_course,
//            ]);
//            $video = $sessions->addMediaFromRequest('video')->toMediaCollection();
//            $sessions->update([
//                'video'=>$video->getUrl()
// ]);

        return response()->json(['message' => 'Data saved successfully'], 200);
    } catch (Exception $e) {


        }
    }


//        $lecture_id= Lecturer::where('id', $request->lecturer_id)->first();
//        $category_course_id=CategoryCourse::where('id' , $request->category_course_id)->first();
//
//        $course= Course::create([
//            'title' => $request->title,
//            'Description' => $request->Description,
//            'price' => $request->price,
//            'time' => $request->time,
//            'lecturer_id' => $lecture_id['id'],
//            'category_course_id' => $category_course_id['id'],
//        ]);
//        $image=$course->addMediaFromRequest('img')->toMediaCollection();
//        $course->update([
//            'img'=>$image->getUrl()
//        ]);
//
//        $parts=Part::create([
//
//            'name_part' => $request->name,
//            'Number_session'=>$request->Number_session,
//            'course_id' => $request->course_id,
//
//        ]);
//        $session= Session::create([
//            'name'=>$request->name,
//            'Duration_course'=>$request->Duration_course,
//            'part_id'=>$request->part_id,
//        ]);
//        $session->addMediaFromRequest('video')->toMediaCollection();
//
//
//        return response()->json([
//            'message' => 'created successfully',
//            'Course' =>$course,$session,$parts
//        ], 201);


    /**
     * ................................
     * .
     * Display the specified resource.
     */
    public function show(Course $course)
    {

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
        $courses = Course::with('parts')->where('course_type', '!=', 'free')->get();
        foreach ($courses as $course) {
            $image = $course->getMedia()->first()->getUrl();
            $data = [
                'data' => $course,
                'image' => $image
            ];
            $datas [] = $data;
        }
        return response()->json([
            'status' => true,
            'data' => $datas
        ]);
    }

    public function free()
    {
//        $course=DB::table('courses')
//            ->join('parts','courses.id','=','parts.course_id')
//            ->where('course_type','free')
//            ->get(['title','img','Description','parts.Number_session']);

        $datas = [];
        $courses = Course::with('parts')->where('course_type', 'free')->get();
        foreach ($courses as $course) {
            $image = $course->getMedia()->first()->getUrl();
            $data = [
                'data' => $course,
                'image' => $image
            ];
            $datas [] = $data;
        }
        return response()->json([
            'status' => true,
            'data' => $datas
        ]);
    }


    public function panel_index(){

        $datas=[];

//        $courses= Course::select('img', 'title', 'price', 'time', 'lecturer_id', 'category_course_id')->get();
        $courses=Course::with('category_course')->get();
        foreach ($courses as $course){
            $image =$course->getMedia()->first()->getUrl();
//       dd($course->lecturer->name);

            $data=[
                'image'=>$image,
                'title'=>$course->title,
                'price'=>$course->price,
                'time'=>$course->time,
                'lecturer_id'=>$course->lecturer->name,
                'category_course_id'=>$course->category_course->name,
            ];
            $datas[]=$data;

            return response()->json([
                'status'=>'success',
                'data'=>$datas
            ]);
        }
    }


}


