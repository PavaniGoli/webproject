<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;
use Auth;

class MainController extends Controller
{
    function main()
    {
        return view('login');
    }

    function checklogin(Request $request)
    {
        $this->validate($request, [
            'email'     =>  'required|email',
            'password'  =>  'required|alphaNum|min:6'
        ]);

        $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
           );
           
    /*if(Auth::attempt($user_data)){
        return redirect('index')->with('message','You have to enter the veriification code here to login');
     }*/
     if (DB::table('users')->where('email', $request->email)->exists()) {
        $userInfo = Auth::user();
        $userInfo = DB::table('users')->where('email', $request->email)->first();
     }
     if($userInfo != null)
     {
         MailController::VerificationEmail($userInfo->name,$userInfo->email,$userInfo->verification_code);
         return redirect()->back()->with('message','Please Check your email for the verification code!');
     }
         
     return redirect()->back()->with('error_message','Please enter a valid email');
   
     /*else
     {
      return back()->with('error', 'Wrong Login Details');
     }*/

    }
    

    function successlogin()
    {
        return view('index');
    }
    
    function logout()
    {
        Auth::logout();
        return redirect('main');
    }

    function register()
    {
        return view('register');
    }

    function signup(Request $request)
    {   
        if (DB::table('users')->where('email', $request->email)->exists()) {
            $userInfo = Auth::user();
            $userInfo = DB::table('users')->where('email', $request->email)->first();
            return redirect()->back()->with('error', 'This user already exists!');
        }
       
        $request->validate([
            'name'             => 'required',
            'email'            => 'required|email',
            'password'         => 'min:6|alphaNum|required_with:confirm_password',
            'confirm_password' => 'min:6|same:password'
        ]);
        $user = User::create([
            'name'         => $request->input('name'),
            'email'        => $request->input('email'),
            'password'     => Hash::make($request->input('password')),
        ]);
        return redirect('/main')->with('message','Successfully Registered and now you can login!');
        //return view('login')->with('message','You have successfully registered and now you can login!');
    }

    function update_info()
    {
        $userInfo = Auth::user();
        return view('update',['userInfo' => $userInfo]);
    }

    function updatedetails(Request $request)
    { 
            $request->validate([
                'name'                 => '',
                'email'                => 'email',
            ]);
            $userInfo=User::find($request->id);
            $userInfo->name=$request->name;
            $userInfo->email=$request->email;
            $userInfo->save();
            return redirect()->back()->with('message', 'You have updated your information succesfully!');
    
    }

    function updatepassword(Request $request)
    { 
            $request->validate([
                
                'new_password'             => 'required|min:6|alphaNum',
                'confirm_password'         => 'required|min:6|same:new_password'
            ]);
            $userInfo=User::find($request->id);
            $userInfo->password=Hash::make($request->input('new_password'));
            $userInfo->save();
            return redirect()->back()->with('message', 'You have updated your information succesfully!');           
    
    }

    function forgotpassword()
    {
        return view('forgotpassword');
    }
    function forgot_password(Request $request)
    {
         
        if (DB::table('users')->where('email', $request->email)->exists()) {
            $userInfo = Auth::user();
            $userInfo = DB::table('users')->where('email', $request->email)->first();

      
    }
        if($userInfo != null)
        {
            MailController::sendForgotPassword($userInfo->name,$userInfo->email,$userInfo->verification_code);
            return redirect()->back()->with('message','Please Check your email to set a new password!');
        }
            
        return redirect()->back()->with('error_message','Please enter a valid email');
    
    }
    public function setnewpassword($email)
    {
        $user=User::where(['email' => $email])->first();
        return view('setnewpassword',['user' => $user]);
    }
    
    public function set_password(Request $request)
    {   
        $request->validate([
         'new_password'         => 'required|min:6|alphaNum|required_with:confirm_password',
         'confirm_password'     => 'required|min:6|same:new_password'
          ]);

          $userInfo=User::find($request->id);
          $userInfo->password=Hash::make($request->input('new_password'));
          $userInfo->save();
          return redirect()->back()->with('message',"You have changed your password successfully!");
    }

    public function verificationpage()
    {
        return view('verificationpage');
    }

    public function verifyuser(Request $request)
    {
        $request->validate([
        'verification_code' => 'alphanum|required',
    ]);
        return view('index');
    }
}
        /*$user = Auth::user();

        if($request->verification_code == $user->verification_code)
        {

            return view('index');
        }
        else{
            return redirect()->back()
            ->with('error','The two factor code you have entered does not match');
        }
    */