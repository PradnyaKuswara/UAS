<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('page/login', [
            'title' => 'Login',
            'active' => 'Login'
        ]);
    }
    public function store(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            // return redirect()->intended('/');
            return response([
                'message' => 'Berhasil Login',
                'user' => Auth::User(),
            ]); //return user data and token in json format

        }
        // return back()->with('loginError', 'Email or Password Invalid');
        return response(['message' => 'We couldnt find and account that matches what you entered'], 401); //return validation if failed log in
    
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}