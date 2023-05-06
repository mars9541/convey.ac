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
        @include('layouts.head')
  </head>
  <body class="fixed-left">
        @include('layouts.preloader')
        @yield('content')
        @include('layouts.footer-script')    
    </body>
</html>