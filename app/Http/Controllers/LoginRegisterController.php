<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRegisterRequest;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginRegisterController extends Controller
{

    public function loginRegister(loginRegisterRequest  $request)
    {
        $inputs = $request->all();
        $inputs['phone_number'] = ltrim($inputs['phone_number'], '0');
//        $inputs['phone_number'] = substr($inputs['phone_number'], 0, 2) === '98' ? substr($inputs['id'], 2) : $inputs['id'];
        $inputs['phone_number'] = str_replace('+98', '', $inputs['phone_number']);

        $user = User::where('phone_number', $inputs['phone_number'])->first();

        if(!empty($user)){
            $newUser['phone_number'] = $inputs['phone_number'];
            $user = User::create($newUser);
            auth()->login($user);
        }
        else{
            return response()->json([
                'status' => false ,
                'message' => 'شماره موبایل صحیحنیست'
            ]);

        }
        $otpCode = rand(111111, 999999);
        $token = Str::random(60);
        $otpInputs = [
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $user->id,
        ];

        Otp::create($otpInputs);
        $sendsms=new SendSmsController();
        $sendsms->send($request->phone_number,$otpCode);
        $token = $user->createToken('api_Token')->plainTextToken;
        auth()->login($user);
//dd(auth()->login($user));
        return response()->json([
            'status' => 'true',
            'message' => 'successfully',
            'token'=>$token
        ]);

    }


    public function SaveVerificationCode(Request $request)
    {

        $user=User::where('phone_number',$request->phone_number)->first();
        // dd($user->otp->otp_code)  ********************************otp=relation#=>otp_code
        if($user->otp->otp_code==$request->otp_code){
            $user->update([
                'verify_code'=>'yes',
            ]);
            return Response()->json([
                'status'=>'true',
                'message'=>'کاربر با موفقیت تایید شد'
            ]);
        }

    }

    public function logoutUser($id)
    {
        $user = User::find($id);
        $user->tokens->each(function ($token) {
            $token->delete();
            Auth::logout();
        });
        return response()->json([
            'message' => 'logout seccessfully',
        ]);
    }



}
