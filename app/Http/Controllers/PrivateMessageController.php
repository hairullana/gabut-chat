<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Events\MessagePrivate;
use App\Events\Notif;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PrivateMessageController extends Controller
{
  public $conversations;

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

    $conversationId = $conversation->id;

    $messages = Message::where(function($query) use ($id2){
                  $query->where('user_id', Auth::user()->id)
                  ->orWhere('user_id', $id2);
                })->where('conversation_id', $conversation->id)->get();
    
    $this->conversations = Conversation::where('user_one', Auth::user()->id)
              ->orWhere('user_two', Auth::user()->id)
              ->get();

    return view('chat.private.chat', [
      'title' => 'Private Chat',
      'u' => User::find($id2),
      'conversations' => $this->conversations,
      'conversationId' => $conversationId,
      'messages' => $messages
    ]);
  }

  public function indexStartChat(){
    $this->conversations = Conversation::where('user_one', Auth::user()->id)
              ->orWhere('user_two', Auth::user()->id)
              ->get();

    return view('chat.private.index', [
      'title' => 'Private Chat',
      'conversations' => $this->conversations
    ]);
  }

  public function sendMessage(Request $request){
    Message::create([
      'conversation_id' => $request->conversation_id,
      'user_id' => $request->sender_id,
      'message' => $request->message
    ]);
    
    event(
      new Notif(
        $request->sender_id,
        $request->sender_username,
        $request->receiver_id
      )
    );
    
    event(
      new MessagePrivate(
        $request->conversation_id,
        $request->sender_id,
        $request->message
      )
    );

  }

  public function search(Request $request){
    if(User::where('username', $request->username)->count() === 0){
      return back()->with('error', 'User not found!');
    }
    
    return redirect('/chat/private/' . $request->username);
  }
}
