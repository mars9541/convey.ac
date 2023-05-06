<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Convey</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        @include('layouts.head')
  </head>
    <body class="pb-0">
        @yield('content')
        @include('layouts.footer')    
        @include('layouts.footer-script')    
    </body>
</html>