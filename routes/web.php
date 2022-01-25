<?php

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessagePublic;
use Illuminate\Http\Response;
use App\Events\MessagePrivate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Conversation;

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
    return view('chat.public', [
        'title' => 'Public Chat'
    ]);
})->middleware('auth');

Route::post('/send-message', function(Request $request) {
    event(
        new MessagePublic(
            $request->username,
            $request->message
        )
    );
})->middleware('auth');

Route::get('/chat/private', function() {
    return view('chat.private', [
        'title' => 'Private Chat',
        'users' => User::where('id', '!=', Auth::user()->id)->latest()->get()
    ]);
})->middleware('auth');

Route::get('/chat/private/{user:id}', function($id) {
    $user1 = User::find(Auth::user()->id)->id;
    $user2 = User::find($id)->id;

    if(Conversation::where('user_one', $user1)->where('user_two', $user2)->first()){
        $conversation = Conversation::where('user_one', $user1)->where('user_two', $user2)->first() ;
    } else if(Conversation::where('user_one', $user2)->where('user_two', $user1)->first()){
        $conversation = Conversation::where('user_one', $user2)->where('user_two', $user1)->first() ;
    } else {
        Conversation::create([
            'user_one' => 1,
            'user_two' => 2
        ]);

        $conversation = Conversation::latest()->first()->first() ;
    }

    return view('chat.private-chat', [
        'title' => 'Private Chat',
        'u' => User::find($id),
        'users' => User::where('id', '!=', Auth::user()->id)->latest()->get(),
        'conversation' => $conversation
    ]);
});

Route::post('/send-private-message', function(Request $request) {
    Message::create([
        'conversation_id' => $request->conversation_id,
        'user_id' => $request->user_id,
        'message' => $request->message
    ]);
    event(
        new MessagePrivate(
            $request->conversation_id,
            $request->user_id,
            $request->message
        )
    );
});

// admin/user
Route::resource('/admin/user', UserController::class)->middleware('auth');