<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class admincontroller extends Controller
{
    public function adminRegister(){
        return view('adminRegister');
    }
    public function adminStore(Request $request){
     
        $validated = $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' =>'required|same:password',
            'role'=>'required',
            'address'=>'required',
            
        ]);
        
        $data =[
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'role'=>$request->role,
            'address'=>$request->address,

            
        ];
        
        admin ::create($data);
        session()->flash('flase_message','Register successfully');
        return redirect()->back();
    }
    public function adminLogin(){

        return view('adminLogin');
    }
    public function LoginIn(Request $request)
    {
       
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            

        ]);
   
        $credentials = $request->only('email', 'password',);
        
        if (Auth::attempt($credentials)){
           $role =Auth::user()->role;
           if ($role == 'admin') 
           {
            return redirect('category')->withSuccess('You have Successfully login');

           }elseif ($role == 'user')
           {
            return redirect('index')->withSuccess('You have Successfully login');
            }else{

            return redirect("adminLogin")->with('flase_message','Oppes! You have entered invalid Email or password');
            }
        }
    }
    
 
    public function logout(){
        Session::flush();
        Auth::logout();
  
        return Redirect('adminLogin');
    }
    
   
}

