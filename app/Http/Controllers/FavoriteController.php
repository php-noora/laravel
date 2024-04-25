<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;


class FavoriteController extends Controller
{
    public function addFavoriteCourse(Request $request){
        $user=auth()->user();
        $user->courseFavorites()->attach($request->course_id);

        return response()->json([
            'status'=>'favarite course successfully',
            'course'=>$request->course_id,
        ]);

    }


    public function showFavoriteCourse(Request $request){
        $user=auth()->user();
        foreach ($user->courseFavorites as $courseFavorite) {
            $image = $courseFavorite->getMedia();
            $data = [
                'data'=>$courseFavorite,
                'image'=>$image
            ];
            $datas []= $data;
        }
        return response()->json([
            'status' => true,
            'message' => 'successfully',
            'data' => $datas,
        ]);

    }
}
