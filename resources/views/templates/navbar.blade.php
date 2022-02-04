<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="/css/app.css">

    <title>{{ $title }} - Gaboet</title>

    @if (Auth::check())
      <script>
        const userIdLogin = "{{ Auth::user()->id }}"
      </script>
    @endif
  </head>
  <body>
    {{-- font awesome --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">Gaboet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <ul class="navbar-nav ml-auto"></ul>
          <div class="navbar-nav">
            <a class="nav-link @if($title == 'Home') active @endif" aria-current="page" href="/">Home</a>
            @if (Auth::check())
              <a class="nav-link @if($title == 'Private Chat') active @endif" href="/chat/private">Private Chat</a>
              <a class="nav-link @if($title == 'Public Chat') active @endif" href="/chat/public">Public Chat</a>
              <a class="nav-link" href="/logout">Logout</a>
            @else
              <a class="nav-link @if($title == 'Login') active @endif" href="/login">Login</a>
            @endif
          </div>
        </div>
      </div>
    </nav>