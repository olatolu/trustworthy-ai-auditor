<!DOCTYPE html>
<html ang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{ trans('panel.site_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('top-scripts')
    <link rel="stylesheet" href="{{ asset('app/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('app/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('app/assets/css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{asset('app/assets/css/colors/switch.css')}}">
    <!-- Color Alternatives -->
    <link href="{{ asset('app/assets/css/colors/color-2.css') }}" rel="alternate stylesheet" type="text/css" title="color-2">
    <link href="{{ asset('app/assets/css/colors/color-3.css') }}" rel="alternate stylesheet" type="text/css" title="color-3">
    <link href="{{ asset('app/assets/css/colors/color-4.css') }}" rel="alternate stylesheet" type="text/css" title="color-4">
    <link href="{{ asset('app/assets/css/colors/color-5.css') }}" rel="alternate stylesheet" type="text/css" title="color-5">

    @stack('styles')
</head>

<body>

@yield('content')

<script src="{{asset('app/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('app/assets/js/jquery.validate.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('app/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('app/assets/js/main.js')}}"></script>
<script src="{{asset('app/assets/js/multi-countdown.js')}}"></script>
<script src="{{asset('app/assets/js/switch.js')}}"></script>

@stack('scripts')


</body>

</html>
