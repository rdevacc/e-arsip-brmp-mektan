<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('apps.login.index');
    }

    public function authenticate(Request $request): RedirectResponse
    {
       $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/app/dashboard');
        }
 
        return back()->withInput()->with('loginError', 'Login Failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}
