<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request){
        $data = $request->validate([
            'username' => ['required', 'min:3', 'max:16'],
            'password' => ['required', 'min:3', 'max:256', 'confirmed']
        ]);

        $data['password'] = Hash::make($data['password']);
    
        User::create($data);
    
        return redirect('/login')->with('success', 'Registration successfull! Please login.');
    }

}
