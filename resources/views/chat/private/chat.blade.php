@extends('chat.templates.private-chat-layout')

@section('body')

  <input type="hidden" id="messageType" value="private">

  {{-- chat header --}}
  <div class="chat">
    <div class="chat-header clearfix">
      <div class="row">
        <div class="col-lg-6">
          <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
          </a>
          <div class="chat-about">
            <h6 class="m-b-0">{{ $u->username }}</h6>
            <small>Last seen: x hours ago</small>
          </div>
        </div>
      </div>
  </div>
  {{-- end chat header --}}

  {{-- chat body --}}
  <div class="chat-history" id="chat-history">
    <ul id="privateMessage">
      @foreach ($messages as $message)
        @if ($message->user_id == Auth::user()->id)
          <li class="clearfix">
            <div class="message-data text-right">
              <span class="message-data-time">{{ date_format($message->created_at, "H:i (d M Y)") }}</span>
              <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
            </div>
            <div class="message other-message float-right">{{ $message->message }}</div>
          </li>
        @else
          <li class="clearfix">
            <div class="message-data">
              <span class="message-data-time">{{ date_format($message->created_at, "H:i (d M Y)") }}</span>
            </div>
            <div class="message my-message">{{ $message->message }}</div>                                    
          </li>
        @endif
      @endforeach
    </ul>
  </div>
  {{-- end chat body --}}

  {{-- message form --}}
  <div class="chatMessageClearfix">
    <form id="privateMessageForm">
      <input type="hidden" name="conversation_id" id="conversationId" value="{{ $conversation->id }}">
      <input type="hidden" name="user_id" id="userId" value="{{ Auth::user()->id }}">
      <div class="input-group mb-1">
        <input type="text" name="message" id="privateMessageInput" class="form-control" placeholder="Enter text here..." autocomplete="off">                                    
        <div class="input-group-prepend">
          <button class="btn btn-primary">Send</button>
        </div>
      </div>
    </form>
  </div>
  {{-- end message form --}}

  <script>
    const userIdLogin = "{{ Auth::user()->id }}"
  </script>
  <script src="/js/app.js"></script>
  <script>
    document.getElementById('privateMessageForm').addEventListener('submit', function() {
        document.getElementById('privateMessageInput').value = '';
    });
  </script>

@endsection