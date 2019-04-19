@extends('frontend.layouts.app')

@section('content')
    <div class="container" style="min-height: 180px;">
        <div class="col-md-12">
            <div class="wpb_wrapper">
                <div class="section-header">
                    <h3 class="widget-title"><i class="fa fa-play"></i> Nuevos Estrenos</h3>
                </div>

                <div class="row columns-6 video-section">
                    @foreach($movies as $movie)
                        <div class="col-md-2 col-sm-6 col-xs-6 item responsive-height post video-home">
                            <div class="item-img">
                                <a title="{{ $movie->name }}"
                                   href="{{ route('frontend.movie.index', $movie->name_url) }}">
                                    <img src="{{ $movie->thumb_url }}"
                                         class="img-responsive video-home-img" alt="Watch {{ $movie->name }}"/>
                                </a>
                                <a title="{{ $movie->name }}"
                                   href="{{ route('frontend.movie.index', $movie->name_url) }}">
                                    <div class="img-hover"></div>
                                </a>
                            </div>
                            <h3><a title="{{ $movie->name }}"
                                   href="{{ route('frontend.movie.index', $movie->name_url) }}">{{ $movie->name }}</a>
                            </h3>
                            <div class="meta">
                                <span class="date">{{ $movie->created_at->format('F d ,Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
