<div class="app">
  @include('templates.navbar')
  <div class="mt-5">
    <div class="container my-3">
      @yield('body')
    </div>
  </div>
  @include('templates.footer')
</div>