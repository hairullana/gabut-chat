@extends('chat.templates.public-chat-layout')

@section('body')
  <input type="hidden" id="messageType" value="public">
  <div class="app">
    <header>
        <h1 class="title">Gaboet Chat</h1>
        <input type="text" value="Username: {{ Auth::user()->username }}" disabled>
        <input type="hidden" name="username" id="username" value="{{ Auth::user()->username }}">
    </header>

    <div id="messages">
      @foreach ($messages as $message)
        <div class='message my-2'><strong>{{ $message->user->username }}:</strong> {{ $message->message }}</div>
      @endforeach
    </div>

    <form id="message_form">
      <input type="text" name="message" id="message_input" placeholder="Message" autocomplete="off">
      <button id="message_send">Send</button>
    </form>
  </div>

  <script src="/js/app.js"></script>
  <script>
    document.getElementById('message_form').addEventListener('submit', function() {
        document.getElementById('message_input').value = '';
    });
  </script>
@endsection