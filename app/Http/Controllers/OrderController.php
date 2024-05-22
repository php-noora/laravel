<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function saveOrder(Request $request){
        $order_number=random_int(1000,9999);
        $user=auth()->user();
        $user->courses()->attach($request->course_id,
            [
            'order_number' => $order_number,
            'created_at'=>now(),
            'updated_at'=>now()
            ]);

//        -------********************number_sale****************
        $course=Course::find($request->course_id);
        $course->update([
           'sales_number'=>++$course->sales_number ,
//            'course_type'=>'saleable',
        ]);

        return response()->json([
           'status'=>'sucsess_order',
        'order'=>$course,
        ]);

    }

    public function orderShow(Request $request){
        $user=auth()->user();
        foreach ($user->courses as $course) {
            $image = $course->getMedia();
            $data = [
                'data'=>$course,
                'image'=>$image
            ];
            $datas []= $data;
        }
        return response()->json([
            'status' => true,
            'data' => $datas,
        ]);

    }

    public function Total_orders(Request $request){
    }




}
