<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>CONVEY - Conveyable Employment Records are digital files that CONVEY from one employer to the next and are used by businesses looking to improve their Employee Value Proposition.</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="_token" content="{{csrf_token()}}" />
        <meta property="og:url" name="og_url"           content="{{url('/more')}}/{{$gallery_info->id}}" />
        <meta property="og:type" name="og_type"          content="website" />
        <meta property="og:title" name="og_title"         content="{{$gallery_info->gallery_title}}" />
{{--        <meta property="og:description"   content="Your description" />--}}
        <meta property="og:image" name="og_image"         content="{{url('public/upload/images')}}/{{$gallery_info->path_big}}" />

        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="{{url('/more')}}/{{$gallery_info->id}}"/>
        <meta name="twitter:title" content="{{$gallery_info->gallery_title}}"/>
{{--        <meta name="twitter:description" content="Avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter"/>--}}
        <meta name="twitter:image" content="{{url('public/upload/images')}}/{{$gallery_info->path_big}}"/>
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
