@extends('templates.layout')

@section('body')
  <h1 class="text-center my-3">User Management</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Username</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $user->id }}</th>
          <td>{{ $user->username }}</td>
          <td>{{ $user->created_at }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{-- paginate --}}
  <div class="d-flex justify-content-center">
    {{ $users->appends(request()->all())->links() }}
  </div>
@endsection