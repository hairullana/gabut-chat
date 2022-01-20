<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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

}
