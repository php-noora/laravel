<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class SendMenuController extends Controller
{
    public function sendMenu(){
        $article=Course::all(['title','image']);
        return response([
            'status'=>true,
            'article'=>$article,
        ]);
    }
}
