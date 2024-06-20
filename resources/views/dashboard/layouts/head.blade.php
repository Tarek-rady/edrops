

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
<meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
<meta name="author" content="PIXINVENT">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<title> @yield('title')</title>
<!-- App favicon -->
<!-- App favicon -->

@php
    $lang = config('app.locale');
@endphp

@if ($lang == 'ar')
<link href="{{ asset('dashboard') }}/assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard') }}/assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard') }}/assets/css/custom-rtl.min.css" rel="stylesheet" type="text/css" />
@else
<link href="{{ asset('dashboard') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard') }}/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
@endif
<link rel="shortcut icon" href="{{ asset('img/logo2.jpeg') }}">



<!-- dropzone css -->
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/libs/dropzone/dropzone.css" type="text/css" />


<!-- Layout config Js -->
<script src="{{ asset('dashboard') }}/assets/js/layout.js"></script>
<!-- Bootstrap Css -->
<!-- Icons Css -->
<link href="{{ asset('dashboard') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<!-- custom Css-->

<link href="{{ asset('dashboard/assets/css/cdn.datatables.net_1.13.6_css_jquery.dataTables.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<link href="{{ asset('dashboard') }}/assets/css/custom-style.css" rel="stylesheet" type="text/css" />


@yield('css')
