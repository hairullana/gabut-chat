<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register() {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function registerAction(Request $request){
        $data = $request->validate([
            'username' => ['required', 'min:3', 'max:16'],
            'password' => ['required', 'min:3', 'max:256', 'confirmed']
        ]);

        $data['password'] = Hash::make($data['password']);
    
        User::create($data);
    
        return redirect('/login')->with('success', 'Registration successfull! Please login.');
    }

    public function login() {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function loginAction(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'Login failed!');
    }

    public function logout(Request $request) {
        Auth::logout();
        
        // suapaya gak bisa dipake
        $request->session()->invalidate();
    
        // supaya tidak dibajak
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}