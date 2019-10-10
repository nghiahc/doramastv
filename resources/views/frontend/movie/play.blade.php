@extends('frontend.layouts.movie')

@section('content')

    <div class="video-info small">
        <h1>{{ $movie->name }}{{ $isMovie ? '' : ' - Capítulo ' . $current_episode->name }}</h1>
    </div>

    <div class="player player-small embed-responsive embed-responsive-16by9">
        <div id="box-player" class="box-player" style="max-width: 100%;">
            <form action="{{ $hostingUrl }}" method="POST" target="_blank">
                <input type="hidden" name="{{ encryptDecrypt('encrypt', 'back_url') }}"
                       value="{{ encryptDecrypt('encrypt', url()->current()) }}">
                <input type="hidden" name="{{ encryptDecrypt('encrypt', 'video_url') }}"
                       value="{{ encryptDecrypt('encrypt', route('frontend.video.index', $current_episode->id)) }}">
                <input type="hidden" name="{{ encryptDecrypt('encrypt', 'back_label') }}"
                       value="{{ encryptDecrypt('encrypt', 'Volver a la Lista de Episodios') }}">
                <a href="#" class="redirect-movie">
                    <img class="" src="{{ asset('img/frontend/video_player.png') }}" alt="" width="100%"
                         height="500">
                </a>
            </form>
        </div>
    </div>

    <div class="video-actions">
        <div class="server-list">
            <button class="video-server-btn active" id="video-server-0" data-id="0">Servidor 1</button>
            <button class="video-server-btn" id="video-server-1" data-id="1">Servidor 2</button>
        </div>
        <div class="social-share-buttons">
            {!! (string) Share::currentPage($title, [], "<span><img src=" . asset('img/frontend/social/facebook.png') . ">", '</span>')->facebook() !!}
            {!! (string) Share::currentPage($title, [], "<span><img src=" . asset('img/frontend/social/twitter.png') . ">", '</span>')->twitter() !!}
            {!! (string) Share::currentPage($title, [], "<span><img src=" . asset('img/frontend/social/googleplus.png') . ">", '</span>')->googlePlus() !!}
            {!! (string) Share::currentPage($title, [], "<span><img src=" . asset('img/frontend/social/linkedin.png') . ">", '</span>')->linkedin() !!}
            {!! (string) Share::currentPage($title, [], "<span><img src=" . asset('img/frontend/social/whatsapp.png') . ">", '</span>')->whatsapp() !!}
        </div>
    </div>

    <div class="clear"></div>

    <div class="video-details">
        <span class="meta">
        <span class="meta-info">Categoría</span>
                <a href="{{ $categoryUrl }}"
                   rel="tag"
                   title="{{ $categoryName }}">{{ $categoryName }}</a>
            <a href="{{ route('frontend.movie.index', $movie->name_url) }}"
               title="{{ $movie->name }}"
               rel="tag">{{ $movie->name ?: null }}</a>
            </span>
    </div>

    <div class="clear"></div>

    @if(!$isMovie)
        <div class="watch-frame">
            <div class="watch-episode-title">Ver & Descargar</div>
            <div class="scroll-episode" itemprop="episode" itemscope itemtype="http://schema.org/TVEpisode">
                @foreach($episodeWatchList as $episodeWatch)
                    <meta content="{{ $movie->name }} - Capítulo {{ $episodeWatch->name }}"
                          itemprop="name">
                    <meta content="{{ $episodeWatch->name }}" itemprop="position">
                    <a itemprop="url"
                       href="{{ route('frontend.play.index', $episodeWatch->name_url) }}"
                       title="Ver {{ $movie->name }} - Capítulo {{ $episodeWatch->name }}"
                       @if($current_episode->id === $episodeWatch->id) class="current" @endif >Capítulo {{ $episodeWatch->name }}</a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="comments">
        <div id="disqus_thread"></div>
    </div>

    @include('frontend.includes.ads.native')

    <div class="video-details">
        @if($tags)
            <span class="meta">
                <span class="meta-info">Etiquetas</span>
                @foreach($tags as $paramName => $tag)
                    <a href="{{ route('frontend.tag.index', $paramName) }}"
                       rel="tag"
                       title="{{ $tag }}">{{ $tag }}</a>
                @endforeach
            </span>
        @endif
    </div>

    <div class="keywords">
        <h4>@php echo implode(', ', $tags); @endphp</h4>
    </div>

    @push('after-scripts')
        @include('frontend.movie.includes.redirect_js_scripts')
    @endpush
@endsection
