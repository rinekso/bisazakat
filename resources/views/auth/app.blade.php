<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body class="app">

    @include('admin.partials.spinner')

    <div class="peers ai-s fxw-nw h-100vh">
      <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image: url("/images/bg.jpg")'>
        <div style="
        height: 100%;
        background: #56CCF2;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, rgba(159,221,255,0.8), rgba(84,255,109,0.8));  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, rgba(159,221,255,0.8), rgba(136,170,255,0.9)); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
        <div class="col-12 col-md-12 peer pX-40 pY-40 h-100">
          <img src="{{ asset('images/logo-transparent.png') }}" alt="" style="z-index: 99999; margin-right: 20px; image-rendering: auto;
  image-rendering: crisp-edges;" height="200px" class="pos-a centerXY">

        </div>
        </div>
      </div>
      <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
        @yield('content')
      </div>
    </div>
  
</body>
</html>
