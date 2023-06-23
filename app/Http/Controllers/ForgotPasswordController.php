<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm(){
        return view('auth.forgetPassword');
    }
    public function submitForgetPasswordForm(Request $request){
        $request->validate([
            'email' => 'required',
        ]);
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('flase_message', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token) { 
        return view('auth.forgetPasswordLink', ['token' => $token]);
     }
     public function submitResetPasswordForm(Request $request)
      {
       
          $request->validate([
              'email' => 'required|email|exists:admin',
              'password' => 'required|min:6',
            'cpassword' =>'required|same:password',
          ]);
          
  
          $updatePassword = DB::table('password_reset_tokens')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();
                             
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = admin::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
  
          return redirect('userLogin')->with('flase_message', 'Your password has been changed!');
      }
}
 
    


