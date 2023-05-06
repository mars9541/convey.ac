<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>CONVEY - Conveyable Employment Records are digital files that CONVEY from one employer to the next and are used by businesses looking to improve their Employee Value Proposition.</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="_token" content="{{csrf_token()}}" />
        @include('layouts.frontend-head')
  </head>
<body>
@include('layouts.frontend-preloader')
@include('layouts.frontend-topbar')
     @yield('breadcrumb')
     @yield('content')
@include('layouts.frontend-footer')
@include('layouts.frontend-footer-script')
    </body>
</html>
