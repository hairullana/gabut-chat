<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessagePublic;
use App\Models\PublicMessage;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PublicMessageController extends Controller{
  
  public function index() {
    return view('chat.public.index', [
      'title' => 'Public Chat',
      'messages' => PublicMessage::get()
    ]);
  }

  public function sendMessage(Request $request){
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
  }
}
