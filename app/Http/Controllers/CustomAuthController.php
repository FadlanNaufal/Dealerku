<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function showLogin(Request $request){
        return view('auth.login');
     }

     public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        
        $hashedPassword = User::where('email', $request->email)->first();
        $user = User::where('email', $request->email)->first();

        if ($hashedPassword && Hash::check($password, $hashedPassword->password)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }else{
            return back()->with('error','Email/password is Invalid');
        }                                
     }


     public function showRegister(Request $request){
        return view('auth.register');
     }

     public function register(Request $request)
     {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string','min:8', 'confirmed'],
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Account Successfully Registered');
     }    


     public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->guest(route( 'login' ));
    }

}
