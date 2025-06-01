<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    //
    public function loginPage()
    {
        $email = Cookie::get('email');
        return view('login',compact('email'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | confirmed'
        ]);

        $user = User::create($data);
        if ($user) {
            return redirect()->route('login')->with('success', 'User Successfully Registered');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required | email',
            'password' => 'required'
        ]);
        $remember = $request->has('remember');
        $user = User::where('email', '=', $request->email)->first();
        if (Auth::attempt($credentials)) {
            $request->session()->put('loginId', $user->id);
            if($remember){
                Cookie::queue('email',$request->email,60);
            }
            else{
                Cookie::queue(Cookie::forget('email'));
            }
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('fail', 'Invalid login details');
        }
    }

    public function dashboardPage()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard', compact('data'));
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            $data = array();
            Auth::logout();
            Session::pull('loginId');
            return redirect()->route('login');
        }
    }
}
