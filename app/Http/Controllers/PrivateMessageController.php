<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Events\MessagePrivate;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PrivateMessageController extends Controller
{
  public function index($id){
    $user1 = User::find(Auth::user()->id)->id;
    $user2 = User::find($id)->id;

    if(Conversation::where('user_one', $user1)->where('user_two', $user2)->first()){
      $conversation = Conversation::where('user_one', $user1)->where('user_two', $user2)->first();
    } else if(Conversation::where('user_one', $user2)->where('user_two', $user1)->first()){
      $conversation = Conversation::where('user_one', $user2)->where('user_two', $user1)->first();
    } else {
      Conversation::create([
        'user_one' => $user1,
        'user_two' => $user2
      ]);

      $conversation = Conversation::latest()->first();
    }

    $messages = Message::where(function($query) use ($id){
                  $query->where('user_id', Auth::user()->id)
                  ->orWhere('user_id', $id);
                })->where('conversation_id', $conversation->id)->get();

    return view('chat..private.chat', [
      'title' => 'Private Chat',
      'u' => User::find($id),
      'users' => User::where('id', '!=', Auth::user()->id)->latest()->get(),
      'conversation' => $conversation,
      'messages' => $messages
    ]);
  }

  public function indexStartChat(){
    return view('chat.private.index', [
      'title' => 'Private Chat',
      'users' => User::where('id', '!=', Auth::user()->id)->latest()->get()
    ]);
  }

  public function sendMessage(Request $request){
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
  }
}
