@extends('frontend.layouts.movie')

@section('content')

    <div class="video-info small">
        <h1>{{ $movie->title }}</h1>
    </div>

    <div class="poster">
        <a itemprop="url" href="{{ route('frontend.play.index', $episode->name_url) }}"
           title="Ver {{ $movie->name }}">
            <img title="Ver {{ $movie->name }}" src="{{ $movie->thumb_url }}" alt="{{ $movie->name }}"
                 itemprop="image">
            <img title="Ver {{ $movie->name }}" alt="{{ $movie->name }}" class="hidden"
                 itemprop="thumbnailUrl" src="{{ $movie->thumb_url }}">
            <div class="img-hover"></div>
        </a>
    </div>
    <div class="text-info">
        @if($movie->alternate_name)
            <div>Nombre alternativo: <b class="text-red">{{ $movie->alternate_name }}</b></div>
        @endif
        <div>
            Estatus: <b class="text-red">{{ $movie->is_end ? 'Terminado' : 'Exhibiendo' }}</b>
        </div>
        @if($movie->cast)
            <div>Actores: <b>{{ $movie->actors }}</b></div>
        @endif

        @if($movie->genres)
            <div>Géneros: <b>{{ $movie->genres }}</b></div>
        @endif

        @if($movie->release_year)
            <div>Estrenos:
                <b>{{ $movie->release_year != '0000-00-00' ? $movie->release_year : 'Unknown' }}</b>
            </div>
        @endif

        @if($movie->country)
            <div>País: <b>{{ $movie->country }}</b></div>
        @endif
        <meta itemprop="description" content="{{ $movie->description }}">
        <div>
            <span class="watch-online-button">
                     @if($episode)
                    <a href="{{ route('frontend.play.index', $episode->name_url) }}"
                       title="Ver {{ $movie->name }}">Ver en linea</a>
                @else
                    <a title="{{ $movie->name }}"
                       onclick="alert('La pelicula viene pronto');return false;">Ver en linea</a>
                @endif
            </span>
        </div>
    </div>

    <div class="clear"></div>

    <div class="video-details">
        <div class="post-entry">
            <div class="content-more-js">
                <p>La película
                    <b>{{ $movie->name }}:</b>&#8203; {{ $movie->description }}.&#8203;
                </p>
            </div>
        </div>

        <span class="meta">
            <span class="meta-info">Categoría</span>
                <a href="{{ $categoryUrl }}"
                   rel="tag"
                   title="{{ $categoryName }}">{{ $categoryName }}</a>
            </span>
        <span class="meta"></span>
    </div>

    <div class="clear"></div>
    @if(!$isMovie)
        <div class="watch-frame">
            <ul>
                <li class="watch-title">
                    <div><b>Ver en linea</b></div>
                </li>
                @foreach($episodeWatchList as $episodeWatch)
                    <li>
                        <div class="watch-item">
                            <a itemprop="episodeName"
                               href="{{ route('frontend.play.index', $episodeWatch->name_url) }}"
                               title="Ver {{ $movie->name }} - Capítulo {{ $episodeWatch->name }}">Reloj {{ $movie->name }}
                                - Capítulo {{ $episodeWatch->name }}</a>
                        </div>
                        <div class="watch-time">{{ $episodeWatch->updated_at->format('Y-m-d') }}</div>
                    </li>
                @endforeach
                @if($isShowMore)
                    <li class="show-more">
                        <div class="watch-item">
                            <a href="{{ route('frontend.play.index', $episode->name_url) }}"
                               title="Ver {{ $movie->name }}"><b>Mostrar más ...</b>
                            </a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    @endif

    <div class="comments">
        <div id="disqus_thread"></div>
    </div>

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

@endsection
