<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Melipayamak\MelipayamakApi;

class SendSmsController extends Controller
{

    public function send($phone_number,$otpcode)
    {
        $username = '09901950098';
        $password = 'QY5!H';
        $api = new MelipayamakApi($username, $password);
        $sms = $api->sms();
        $to =  $phone_number;
        $from = '50002710050098';
        $text = "می باشد."."$otpcode"."کد تاییدیه شما ";
        $response = $sms->send($to, $from, $text);
    }
}
