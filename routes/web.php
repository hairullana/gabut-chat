<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrivateMessageController;
use App\Http\Controllers\PublicMessageController;
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

// INDEX
Route::get('/', function () {
    return view('index', [
        'title' => 'Home'
    ]);
})->middleware('auth');

// REGISTER
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'registerAction'])->middleware('guest');
// LOGIN
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware(('guest'));
Route::post('/login', [AuthController::class, 'loginAction'])->middleware(('guest'));
Route::get('/logout', [AuthController::class, 'logout'])->middleware(('auth'));

// CHAT
Route::middleware('auth')->group(function(){
  // PUBLIC CHAT
  Route::get('/chat/public', [PublicMessageController::class, 'index']);
  Route::post('/send-message', [PublicMessageController::class, 'sendMessage']);
  // PRIVATE CHAT
  Route::get('/chat/private', [PrivateMessageController::class, 'indexStartChat']);
  Route::post('/chat/private', [PrivateMessageController::class, 'search']);
  Route::get('/chat/private/{user:username}', [PrivateMessageController::class, 'index']);
  Route::post('/send-private-message', [PrivateMessageController::class, 'sendMessage']);
});

// admin/user
Route::resource('/admin/user', UserController::class)->middleware('auth');
