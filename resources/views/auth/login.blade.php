@extends('templates.layout')

@section('body')
  <div class="row justify-content-center d-flex">
    <div class="col-md-6">
      <h1 class="text-center mb-3">Login</h1>

      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form method="post" action="/login">
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
        <button type="submit" class="btn btn-primary">Login</button>
      </form>

      <p class="mt-2">
        Not have an account ? <a href="/register">Register here</a>
      </p>
    </div>
  </div>
@endsection