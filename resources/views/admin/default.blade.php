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

  @yield('additional-css')
</head>
<body class="app">

    @include('admin.partials.spinner')

    <div>
      <!-- #Left Sidebar ==================== -->
      @include('admin.partials.sidebar')

      <!-- #Main ============================ -->
      <div class="page-container">
        <!-- ### $Topbar ### -->
        @include('admin.partials.topbar')

        <!-- ### $App Screen Content ### -->
        <main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="container-fluid">

              <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>
        
              @include('admin.partials.messages')
              @yield('content')

            </div>
          </div>
        </main>

      </div>
    </div>
  
    <script src="{{ asset('/js/app.js') }}"></script>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor', {
            removePlugins: 'sourcearea',
            filebrowserImageBrowseUrl: '/files?type=Images',
            filebrowserImageUploadUrl: '/files/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/files?type=Files',
            filebrowserUploadUrl: '/files/upload?type=Files&_token='
        });
    </script>

    @yield('additional-script')

</body>
</html>
