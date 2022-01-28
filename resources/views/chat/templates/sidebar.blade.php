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
    @foreach ($conversations as $conversation)
      <li class="clearfix">
        <?php
          if ($conversation->user_one != Auth::user()->id){
            $user = App\Models\User::find($conversation->user_one);
          }else{
            $user = App\Models\User::find($conversation->user_two);
          }
        ?>
        <a href="/chat/private/{{ $user->username }}">
          <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
          <div class="about">
            <div class="name">{{ $user->username }}</div>
            <div class="status">
              @if(Cache::has('user-is-online-' . $user->id))
                <i class="fa fa-circle online"></i>
                <span class="text-success">Online</span>
              @else
                <i class="fa fa-circle offline"></i>
                {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
              @endif
            </div>
          </div>
        </a>
      </li>
    @endforeach
  </ul>
</div>
{{-- end sidebar --}}