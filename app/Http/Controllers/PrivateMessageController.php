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
  public function index(User $user){
    $id1 = User::find(Auth::user()->id)->id;
    $id2 = $user->id;

    if($id1 === $id2) return abort(404);

    if(Conversation::where('user_one', $id1)->where('user_two', $id2)->first()){
      $conversation = Conversation::where('user_one', $id1)->where('user_two', $id2)->first();
    } else if(Conversation::where('user_one', $id2)->where('user_two', $id1)->first()){
      $conversation = Conversation::where('user_one', $id2)->where('user_two', $id1)->first();
    } else {
      Conversation::create([
        'user_one' => $id1,
        'user_two' => $id2
      ]);

      $conversation = Conversation::latest()->first();
    }

    $messages = Message::where(function($query) use ($id2){
                  $query->where('user_id', Auth::user()->id)
                  ->orWhere('user_id', $id2);
                })->where('conversation_id', $conversation->id)->get();

    return view('chat..private.chat', [
      'title' => 'Private Chat',
      'u' => User::find($id2),
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
