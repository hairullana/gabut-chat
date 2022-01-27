@include('templates.navbar')
<div class="mt-5">
  <input type="hidden" id="messageType" value="public">
  @yield('body')
</div>

{{-- bootstrap bundle --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>