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
        $CategoryCourses=CategoryCourse::all();
        foreach($CategoryCourses as $CategoryCourse){
            $image=$CategoryCourse->getMedia();
            $data=[
                'data'=>$CategoryCourse,
                'image'=>$image,
            ];
            $data[]=$data;
        }
        return response()->json([
            'data' => $data,
        ]);

    }




}
