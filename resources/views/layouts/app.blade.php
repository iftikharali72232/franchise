<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', trans('lang.labeey')) }}</title>
    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css"> -->
    <!-- Styles -->
    <?php if(app()->isLocale('ar')){ ?>
        <link rel="stylesheet" href="{{ asset('css/style.rtl.css') }}">
    <?php }else { ?>
          <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <?php } ?>


     <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->


  <!-- Favicons -->
  <link href="{{asset('img/favicon.png')}}" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- font awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

  <!-- Vendor CSS Files -->
  <!-- <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet"> -->
  <!-- <link href="{{asset('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet"> -->
  <link href="{{asset('vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  <!-- light slider  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightslider@1.1.6/dist/css/lightslider.min.css">
  <script src="https://cdn.jsdelivr.net/npm/lightslider@1.1.6/dist/js/lightslider.min.js"></script>

  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  
<body>

    <div class="flex h-screen bg-gray-100">
        <!-- Topnav -->
        @guest

        @else
               <!-- Preloader -->
          <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('img/logo.png')}}" alt="AdminLTELogo" height="60" width="60">
          </div> -->
        <!-- Sidebar -->
        @include('layouts.panel.sidebar')

      @endguest

      @guest
        @yield('content')
      @else
      
      <!-- Main Body -->
      <div class="flex flex-col flex-1 overflow-y-auto">
          <!-- Topnav -->
          @include('layouts.panel.topnav')

          <!-- Content -->
          <div class="p-4">
          @yield('content')
          </div>
      </div>
      @endguest
    </div>
</body>
</html>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="{{asset('vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('js/query.js')}}"></script>
  <!-- <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
  <script src="{{asset('vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('vendor/php-email-form/validate.js')}}"></script>
  

  <!-- Template Main JS File -->
  <script src="{{asset('js/main.js')}}"></script>


