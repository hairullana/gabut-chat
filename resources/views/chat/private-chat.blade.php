@extends('templates.layout-no-footer')

@section('body')

<input type="hidden" id="messageType" value="private">

<div class="private-chat row clearfix mt-5">
  <div class="col-lg-12">
      <div class="card chat-app">
          <div id="plist" class="people-list">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-search"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Search...">
              </div>
              <ul class="list-unstyled chat-list mt-2 mb-0">
                @foreach ($users as $user)
                  <li class="clearfix">
                    <a href="/chat/private/{{ $user->id }}">
                      <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                      <div class="about">
                          <div class="name">{{ $user->username }}</div>
                          <div class="status"> <i class="fa fa-circle offline"></i> left x mins ago </div>                                            
                      </div>
                    </a>
                  </li>
                @endforeach
              </ul>
          </div>
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
                  {{-- <div class="col-lg-6 hidden-sm text-right">
                      <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                      <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                      <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                      <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                  </div> --}}
              </div>
          </div>
          <div class="chat-history">
              <ul class="m-b-0" id="privateMessage">
                {{-- {{ dd($messages->messages->message) }} --}}
                @foreach ($messages as $message)
                  @if ($message->user_id == Auth::user()->id)
                    <li class="clearfix">
                      <div class="message-data text-right">
                          <span class="message-data-time">10:10 AM, Today</span>
                          <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                      </div>
                      <div class="message other-message float-right">
                        {{ $message->message }}
                      </div>
                    </li>
                  @else
                    <li class="clearfix">
                      <div class="message-data">
                          <span class="message-data-time">10:12 AM, Today</span>
                      </div>
                      <div class="message my-message">
                        {{ $message->message }}
                      </div>                                    
                    </li>
                  @endif
                @endforeach
                  {{-- 
                  <li class="clearfix">
                      <div class="message-data">
                          <span class="message-data-time">10:12 AM, Today</span>
                      </div>
                      <div class="message my-message">Are we meeting today?</div>                                    
                  </li>                               
                  <li class="clearfix">
                      <div class="message-data">
                          <span class="message-data-time">10:15 AM, Today</span>
                      </div>
                      <div class="message my-message">Project has been already finished and I have results to show you.</div>
                  </li> --}}
              </ul>
          </div>
          <div class="chatMessageClearfix">
            <form id="privateMessageForm">
              <input type="hidden" name="conversation_id" id="conversationId" value="{{ $conversation->id }}">
              <input type="hidden" name="user_id" id="userId" value="{{ Auth::user()->id }}">
              <div class="input-group mb-1">
                <input type="text" name="message" id="privateMessageInput" class="form-control" placeholder="Enter text here...">                                    
                <div class="input-group-prepend">
                  <button class="btn btn-primary">Send</button>
                </div>
              </div>
            </form>
          </div>
          </div>
      </div>
  </div>
</div>

<script src="/js/app.js"></script>
<script>
  document.getElementById('privateMessageForm').addEventListener('submit', function() {
      document.getElementById('privateMessageInput').value = '';
  });
</script>
@endsection