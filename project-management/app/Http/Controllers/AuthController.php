<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = [
            ["username" => "Reena", "password" => "Value@123"],
            ["username" =>  "Ashok", "password" =>  "password@Ashok"],
            ["username" =>  "Pooja", "password" =>  "password@Pooja"],
            ["username" =>  "Rutul", "password" =>  "password@Rutul"]
        ];

        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username is Required',
            'password.required' => 'Password is Required'
        ]);

        foreach ($credentials as $key => $value) {
            if ($credentials[$key]['username'] == $validate['username'] && $credentials[$key]['password'] == $validate['password']) {
                Session::put('auth_user',$credentials[$key]['username']);
                // $request->session()->put('auth_user',$credentials[$key]['username']);
                // session(['auth_user' => $credentials[$key]['username']]);
                return redirect()->route('projects.index');
            }
        }
        return redirect()->route('login')->with('error', 'Invalid Username or password');
    }
    public function logout(Request $request) {
        if (Session::has('auth_user')) {
            $data = array();
            Auth::logout();
            Session::pull('auth_user');
            Session::forget('auth_user');
            // $request->session()->forget('auth_user');
            // $request->session()->flush();    
            return redirect(route('login'))->with('message', 'Logged out successfully.');
        }
    }
}
