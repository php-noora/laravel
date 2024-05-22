<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\CategoryCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas=[];
        $users=User::all();
        foreach ($users as $user){
            $data= [
                'first_name' => $user->first_name,
                'phone_number' =>$user->phone_number
                ];
            $datas[]=$data;
        }

        return response()->json([
            'status' => true,
            'data' => $datas
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user=User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'date_of_birth'=>$request->date_of_birth,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'profile_photo_path'=>$request->profile_photo_path,

        ]);
        $image= $user->addMediaFromRequest('profile_photo_path')->toMediaCollection();
        $user->update([
            'profile_photo_path'=>$image->getUrl()
        ]);

        return response()->json([
            'message'=>'sucsessfully',
            'date'=>$user,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
//        $user=User::find($id);
//        return response()->jsone([
//            'user'=>$user
//        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            User::find($id)->update($request->all());
            return response()->json([
                'status' => 'true',
                'message' => 'success',
            ]);
        }catch(\exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),

            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $user=User::find($id);
            $user->delete();
            return response()->jsone([
               'status'=>'true',
               'message'=>'delete successfully',
            ]);

        }catch(\Exception $e){
            return response()->jsone([
                'status' => false,
                'message' => "{$e->getMessage()}",
            ]);
        }
    }


    public function users_numbers(){


        dd(123);

//        $datas = [];
//        $categorycourse = CategoryCourse::with('courses')->get();
//        return response()->json([
//            'status' => true,
//            'data' => $categorycourse]);


    }


    public function filter(Request $request){
        $name = $request->input('first_name');


        $users = QueryBuilder::for(User::class)
            ->allowedFilters('first_name')
            ->get();

        return response()->json($users);

//        $users = QueryBuilder::for(User::class)
//            ->allowedFilters('first_name')
//            ->get();
//        return response()->json([
//            'data'=>$users,
//
//        ]);

    }
}
