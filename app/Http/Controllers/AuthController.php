<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    } 


    public function signup(Request $request)
    {
    
        // dd($request->input('age'));
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            
            
    
        ]);
    
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
          
            'password' => bcrypt($request->input('password')), 
        ]);
    
      
        $user->save();
    
       
       return view('auth.login');
    }




    public function login(Request $request){

       
       
        $request->validate([
           
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
      
            // $user = Auth::user();
          
            // $data = User::with('alarm', 'survey')->where('id', $user->id)->first();
            
            
            return view('welcome');
           
            // return response()->json(['message' => 'successful' , 'data' => $data]);
        }
        else{
            
            return back()->with('error', 'Invalid login credentials');
        }

    }
}
