@extends('templates.layout-no-footer')

@section('body')
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
            <h1 class="start-chat">Start Chat</h1>
          </div>
      </div>
  </div>
</div>
@endsection