<?php

use App\Events\Message;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        'title' => 'Private Chat'
    ]);
})->middleware('auth');