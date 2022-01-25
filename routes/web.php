<?php

use App\Models\User;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index', [
        'title' => 'Home'
    ]);
})->middleware('auth');

Route::post('/send-message', function(Request $request) {
    event(
        new Message(
            $request->username,
            $request->message
        )
    );
})->middleware('auth');

// register
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'registerAction'])->middleware('guest');

// login
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware(('guest'));
Route::post('/login', [AuthController::class, 'loginAction'])->middleware(('guest'));
Route::get('/logout', [AuthController::class, 'logout'])->middleware(('auth'));

// chat
Route::get('/chat/public', function() {
    return view('chat.public', [
        'title' => 'Public Chat'
    ]);
})->middleware('auth');

Route::get('/chat/private', function() {
    return view('chat.private', [
        'title' => 'Private Chat',
        'users' => User::where('id', '!=', Auth::user()->id)->latest()->get()
    ]);
})->middleware('auth');

Route::get('/chat/private/{user:id}', function($id) {
    return view('chat.private-chat', [
        'title' => 'Private Chat',
        'u' => User::find($id),
        'users' => User::where('id', '!=', Auth::user()->id)->latest()->get()
    ]);
});

// admin/user
Route::resource('/admin/user', UserController::class)->middleware('auth');