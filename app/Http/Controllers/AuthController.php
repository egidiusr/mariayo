<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function cek_login(Request $request)
    {
        $password   = $request->input('password');
        $email      = $request->input('email');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('/home')->with('success', 'Login Berhasil');
        } else {
            return redirect()->intended('/')->with('error', 'Username atau Password Salah');
        }

        // $credentials = $request->validate([
        //     'email'     => 'required|email:dns',
        //     'password'  => 'required',
        // ]);

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/home')->with('success', 'Login Berhasil');
        // } else {
        //     return redirect()->intended('/')->with('error', 'Username atau Password Salah');
        // };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
