<?php

namespace App\Http\Controllers;

use App\Models\CategoryCourse;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class SendMenuController extends Controller
{
    public function CategoryCourseMenu(){
        $datas = [];
        $CategoryCourses = Course::with('category_course', 'parts')->get();

//        $CategoryCourses=CategoryCourse::with('courses')->get();
        dd($CategoryCourses);
        foreach($CategoryCourses as $CategoryCourse){
            $image=$CategoryCourse->courses()->get();
            dd($image);

//            $image=$CategoryCourse->getMedia();
//            $data=[
//                'data'=>$CategoryCourse,
//                'image'=>$image,
//            ];
//            $data[]=$data;
        }
        return response()->json([
            'data' => $data,
        ]);

    }




}
