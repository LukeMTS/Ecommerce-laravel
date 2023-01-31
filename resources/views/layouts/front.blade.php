<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    @yield('title')
  </title>

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> --}}

  <link rel="stylesheet" href="https://kit.fontawesome.com/2e49bd34cd.css" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/2e49bd34cd.js" crossorigin="anonymous"></script>

  <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/bootstrap5.css') }}" rel="stylesheet">

  {{-- Owl Carousel --}}
  <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  {{-- Google Font --}}
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
  {{-- Font Awesome --}}
  <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" rel="stylesheet">

  <style>
    a {
      text-decoration: none !important;
    }
  </style>

</head>

<body>
  @include('layouts.inc.frontnavbar')
  <div class="content position-absolute w-100" style="margin-top: 3.6em">
    @yield('content')
  </div>

  <script src="{{ asset('frontend/js/jquery-3.6.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/js/custom.js') }}"></script>
  <script src="{{ asset('frontend/js/checkout.js') }}"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @if (session('status'))
  <script>
    swal("{{ session('status') }}");
  </script>
  @endif

  @yield('scripts')
</body>

</html>