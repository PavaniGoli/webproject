<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\ForgotPassword;

class MailController extends Controller
{

    public static function sendForgotPassword($name,$email,$verification_code)
    {
        $data =[
            'name'=>$name,
            'email'=>$email,
            'verification_code'=>$verification_code
        ];
         Mail::to($email)->send(new ForgotPassword($data));
    }

    public static function VerificationEmail($name,$email,$verification_code)
    {
        $data =[
            'name'=>$name,
            'email'=>$email,
            'verification_code'=>$verification_code
        ];
         Mail::to($email)->send(new VerificationEmail($data));
    }
    
}