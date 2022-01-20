@extends('templates.layout')

@section('body')
  <div class="row justify-content-center d-flex">
    <div class="col-md-6">
      <h1 class="text-center mb-3">Login</h1>
      <form method="post" action="/login">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus>
          @error('username')
            <div class="form-text">{{ error('username') }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
          @error('password')
            <div class="form-text">{{ error('password') }}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
@endsection