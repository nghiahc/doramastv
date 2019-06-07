<!DOCTYPE html>
@langrtl
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name='revisit-after' content="1 days"/>
        <meta http-equiv="content-language" content="en"/>
        <meta name="robots" content="index,follow"/>
        <meta name="googlebot" content="index,follow"/>
        <meta name="BingBOT" content="index,follow"/>
        <meta name="yahooBOT" content="index,follow"/>
        <meta name="slurp" content="index,follow"/>
        <meta name="msnbot" content="index,follow"/>
        <meta name="generator"
              content="DoramasTV - Ver doramas online, película asiática, drama asiático, descargue drama, descargue gratis, mejor película de transmisión.">
        <meta name="copyright"
              content="DoramasTV - Ver doramas online, película asiática, drama asiático, descargue drama, descargue gratis, mejor película de transmisión.">
        <meta name="author"
              content="DoramasTV - Ver doramas online, película asiática, drama asiático, descargue drama, descargue gratis, mejor película de transmisión.">

        {!! SEOMeta::generate() !!}
        {!! OpenGraph::generate() !!}
        {!! Twitter::generate() !!}

        <meta name="type" content="website">

        @yield('meta')

        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/frontend/favicon/57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/frontend/favicon/60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/frontend/favicon/72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/frontend/favicon/76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/frontend/favicon/114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/frontend/favicon/120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/frontend/favicon/144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/frontend/favicon/152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/frontend/favicon/180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/frontend/favicon/192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/frontend/favicon/32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/frontend/favicon/96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/frontend/favicon/16.png') }}">

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        {{ style(mix('css/frontend.css')) }}

        <link rel='stylesheet' id='google-font-css'
              href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' type='text/css'
              media='all'/>

        @stack('after-styles')
    </head>

    <body class="page-template page-template-tpl-page-builder vc_responsive">

    <div id="app">
        @include('frontend.includes.header')
        @include('frontend.includes.nav')

        <div class="container" style="min-height: 212px;">
            <div class="row">
                <div class="col-md-8 col-sm-12 main-content">
                    @yield('content')
                </div>
                <div class="col-md-4 col-sm-12 sidebar">
                    @include('frontend.includes.sidebar')
                </div>
            </div>
        </div>
        @include('includes.partials.messages')

        @include('frontend.includes.footer')
    </div><!-- #app -->

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/frontend.js')) !!}
    @stack('after-scripts')

    @include('includes.partials.ga')
    <div class="maintenance">
        <img src="{{ asset('img/frontend/maintenance.jpg') }}">
    </div>
    </body>
    </html>
