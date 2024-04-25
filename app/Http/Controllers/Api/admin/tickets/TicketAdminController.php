<?php

namespace App\Http\Controllers\Api\admin\tickets;

use App\Http\Controllers\Controller;

class TicketAdminController extends Controller
{
    public function index(){
        $admins=User::where('user_type',1)->get();
        return response()->json([
            'status'=>'success',
            'asmins'=>$admins,
        ]);

    }

    public function set(){

    }
}
