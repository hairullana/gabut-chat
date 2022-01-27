{{-- sidebar --}}
<div id="plist" class="people-list">
  {{-- profile --}}
  <div class="profile text-center mb-3">
    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" style="width: 40%; float: none;" alt="avatar">
    <h4 class="m-b-0">{{ Auth::user()->username }}</h4>
  </div>
  {{-- end profile --}}
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
          <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
          <div class="about">
            <div class="name">{{ $user->username }}</div>
            <div class="status"> <i class="fa fa-circle offline"></i> left x mins ago</div>
          </div>
        </a>
      </li>
    @endforeach
  </ul>
</div>
{{-- end sidebar --}}