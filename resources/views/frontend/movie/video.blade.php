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

        <link rel='stylesheet' id='google-font-css'
              href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' type='text/css'
              media='all'/>

        <style>
            body {
                background: black;
            }

            .footer {
                position: fixed;
                left: 0;
                bottom: 2px;
                width: 100%;
                text-align: center;
            }

            .server-list .active {
                background: #e73737 !important;
            }

            .server-list .video-server-btn {
                background: #b2b2b2;
                color: #fff;
                padding: 5px 7px;
                text-transform: uppercase;
                margin-right: 3px;
                border: none;
            }

            .box-player {
                text-align: center;
                color: white;
            }

            .box-player #player {
                position: fixed;
                left: 0;
                right: 0;
            }

        </style>

    </head>

    <body>

    <div id="app">

        <div id="box-player" class="box-player" style="max-width: 100%;">
            <div id="player"></div>
        </div>
        <div class="footer">
            <div class="server-list"></div>
        </div>

        <input type="hidden" name="video-sources" value="{{ $videoSources }}">
        <input type="hidden" name="video-name" value="{{ $videoName }}">
        <input type="hidden" name="vast-tag" value="{{ $vastTag }}">

    </div><!-- #app -->

    <!-- Scripts -->
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/frontend.js')) !!}

    <script type="text/javascript" src="{{ asset('js/jwplayer-8.6.2/jwplayer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jwplayer-8.6.2/related.js') }}"></script>
    @if($agent->browser() === 'Safari')
        <script type="text/javascript"
                src="{{ asset('js/jwplayer-8.6.2/jwplayer.core.controls.polyfills.html5.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jwplayer-8.6.2/provider.airplay.js') }}"></script>
    @else
        <script type="text/javascript"
                src="{{ asset('js/jwplayer-8.6.2/jwplayer.core.controls.html5.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jwplayer-8.6.2/provider.cast.js') }}"></script>
    @endif
    @include('frontend.movie.includes.video_js_scripts')

    </body>
    </html>
