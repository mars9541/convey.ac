<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Convey</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta name="_token" content="{{csrf_token()}}" />
        @include('layouts.head')
  </head>
<body class="fixed-left">
@include('layouts.preloader')
<div id="wrapper">
  @include('layouts.topbar_advisors')
  @include('layouts.sidebar_advisors')
  <div class="content-page">
        <div class="content">
            <div class="page-content-wrapper">
              <div class="container-fluid">
                 @yield('breadcrumb')
                 @yield('content')
              </div>
            </div>
        </div>
        @include('layouts.footer')  
  </div>
</div>
    @include('layouts.footer-script') 
    </body>
</html>