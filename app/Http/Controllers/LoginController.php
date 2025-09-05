<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /**
     * * Tampilkan Halaman Login*
     */
    public function login(){
        return view('apps.auth.index');
    }

    /**
     * * Proses Authentication Login*
     */
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

    /**
     * * Proses Logout *
     */
    public function logout(Request $request)
    {
        Auth::logout();
    
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect()->route('login');
    }

    /**
     * * Tampilkan Halaman Forgot Password *
     */
    public function forgot_password(){
        return view('apps.auth.forgot-password');
    }

    /**
     * * Proses Kirim Reset Link ke Email *
     */
    public function send_reset_link(Request $request){       
        $request->validate(['email' => 'required|email']);
 
        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email', "Email tidak ditemukan."]);
        }

         // Buat token reset password
        $token = Password::broker()->createToken($user);

        // Buat URL reset password + email
        $url = url("/app/password-reset/{$token}?email={$user->email}");

        // Kirim email pakai mailable custom
        Mail::to($user->email)->send(new ResetPasswordMail($url));

        return back()->with('status', 'Link reset password berhasil dikirim ke email Anda!');
    }

    /**
     * * Tampilkan Halaman Reset Password *
     */
    public function password_reset($token, Request $request){
        $email = $request->query('email');
        return view('apps.auth.reset-password', compact('token', 'email'));
    }

    /**
     * * Proses Update Password *
     */
    public function update_password(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }); 

            return $status == Password::PASSWORD_RESET
                        ? redirect()->route('login')->with('status', 'Password berhasil direset! Silakan login.')
                        : back()->withErrors(['email' => "Gagal mereset password. Token mungkin sudah kadaluarsa."]);
    }
}
