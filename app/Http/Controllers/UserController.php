<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() {
        return view('admin.user', [
            'title' => 'User Management',
            'users' => User::latest()->paginate(10)
        ]);
    }
}
