<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      $user=User::all();
      return response()->json([
         'user'=>$user
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user=User::create([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'date_of_birth'=>$request->date_of_birth,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'profile_photo_path'=>$request->profile_photo_path,

        ]);
        $user->addMediaFromRequest('profile_photo_path')->toMediaCollection();

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
        $user=User::find($id);
        return response()->jsone([
            'user'=>$user

        ]);
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
}
