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
        $user->courses()->attach($request->course_id,[
            'order_number' => $order_number,
            'created_at'=>now(),
            'updated_at'=>now()
            ]);

    }
}
