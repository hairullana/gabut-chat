<?php

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Events\MessagePublic;
use Illuminate\Http\Response;
use App\Events\MessagePrivate;
use App\Models\PublicMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrivateMessageController;
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

// register
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'registerAction'])->middleware('guest');

// login
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware(('guest'));
Route::post('/login', [AuthController::class, 'loginAction'])->middleware(('guest'));
Route::get('/logout', [AuthController::class, 'logout'])->middleware(('auth'));

// chat
Route::get('/chat/public', function() {
    return view('chat.public.index', [
        'title' => 'Public Chat',
        'messages' => PublicMessage::get()
    ]);
})->middleware('auth');

Route::post('/send-message', function(Request $request) {
    PublicMessage::create([
        'user_id' => Auth::user()->id,
        'message' => $request->message
    ]);
    
    event(
        new MessagePublic(
            $request->username,
            $request->message
        )
    );
})->middleware('auth');

// PRIVATE CHAT
Route::get('/chat/private', [PrivateMessageController::class, 'indexStartChat'])->middleware('auth');
Route::get('/chat/private/{user:id}', [PrivateMessageController::class, 'index'])->middleware('auth');
Route::post('/send-private-message', [PrivateMessageController::class, 'sendMessage'])->middleware('auth');

// admin/user
Route::resource('/admin/user', UserController::class)->middleware('auth');