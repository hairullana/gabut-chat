@extends('templates.layout')

@section('body')
  <div class="row justify-content-center d-flex">
    <div class="col-md-6">
      <h1 class="text-center mb-3">Registration</h1>
      <form method="post" action="/register">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" required autofocus>
          @error('username')
            <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
          @error('password')
            <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Retype Password</label>
          <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
          @error('password_confirmation')
            <div class="form-text text-danger">{{ $message }}</div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>

      <p class="mt-2">
        Already register ? <a href="/login">Login here</a>
      </p>
    </div>
  </div>
@endsection