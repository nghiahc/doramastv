@extends('frontend.layouts.movie')

@section('content')
    <div class="column_container">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="section-header">
                    <h3 class="widget-title"><i class="fa fa-play"></i> Lista de {{ $movieTypeName }}</h3>
                </div>
                <div class="row columns-2 video-section">
                    @if($movies->isEmpty())
                        No movie
                    @endif
                    @foreach($movies as $movie)
                        <div class="col-md-4 col-sm-4 col-xs-6 item responsive-height post video-search">
                            <div class="item-img">
                                <a title="Ver {{ $movie->name }}"
                                   href="{{ route('frontend.movie.index', $movie->name_url) }}">
                                    <img src="{{ $movie->thumb_url }}"
                                         class="img-responsive video-search-img"
                                         alt="Ver {{ $movie->name }}"
                                         title="Ver {{ $movie->name }}">
                                </a>
                                <a href="{{ route('frontend.movie.index', $movie->name_url) }}">
                                    <div class="img-hover"></div>
                                </a>
                            </div>
                            <h3><a href="{{ route('frontend.movie.index', $movie->name_url) }}">{{ $movie->name }}</a>
                            </h3>
                            @if (!$agent->isMobile())
                                <div class="meta">
                                    <span class="date">{{ $movie->created_at->format('F d ,Y') }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <ul class="pagination">
                    @foreach($pagination as $page => $pageName)
                        <li>
                            @if($page == $current_page)
                                <span aria-current="page" class="page-numbers current">{{ $pageName }}</span>
                            @else
                                <a href="{{ route('frontend.category.index' , ['name_url' => $nameUrl, 'page' => $page]) }}"
                                   class="page-numbers">{{ $pageName }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
