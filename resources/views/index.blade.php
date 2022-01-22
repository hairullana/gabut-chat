@extends('templates.layout-no-footer')

@section('body')
  <div class="app">
    <header>
        <h1>Gaboet Chat</h1>
        <input type="text" value="Username: {{ Auth::user()->username }}" disabled>
        <input type="hidden" name="username" id="username" value="{{ Auth::user()->username }}">
    </header>

    <div id="messages"></div>

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