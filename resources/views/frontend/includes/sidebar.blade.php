<div class="widget mars-posts-sidebar-widget">
    @include('frontend.includes.ads.banner')
</div>

<div class="widget mars-posts-sidebar-widget">
    <h4 class="widget-title">La última actualización</h4>
    <div class="row">
        @foreach(getNewEpisodesForSidebar() as $episode)
            <div class="col-md-6 col-sm-6 col-xs-6 last-updated-item item responsive-height post type-post status-publish format-standard has-post-thumbnail">
                <a title="Ver {{ $episode['title'] }}"
                   href="{{ route('frontend.play.index', $episode['url']) }}">
                    <img src="{{ $episode['thumb_url'] }}"
                         alt="{{ $episode['title'] }}"
                         class="img-responsive wp-post-image">
                </a>
                <div class="post-header">
                    <h3>
                        <a title="Ver {{ $episode['title'] }}"
                           href="{{ route('frontend.play.index', $episode['url']) }}">{{ $episode['name'] }}</a>
                    </h3>
                    <span class="post-meta"><i class="fa fa-clock-o"></i>{{ $episode['release_date'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="widget mars-posts-sidebar-widget">
    <h4 class="widget-title">El último completado</h4>
    <div class="row">
        @foreach(getNewMoviesForSidebar() as $movie)
            <div class="col-md-6 col-sm-6 col-xs-6 last-updated-item item responsive-height post type-post status-publish format-standard has-post-thumbnail">
                <a title="Ver {{ $movie->name }}"
                   href="{{ route('frontend.movie.index', $movie->name_url) }}">
                    <img src="{{ $movie->thumb_url }}"
                         alt="Ver {{ $movie->name }}"
                         class="img-responsive wp-post-image">
                </a>
                <div class="post-header">
                    <h3>
                        <a title="Ver {{ $movie->name }}"
                           href="{{ route('frontend.movie.index', $movie->name_url) }}">{{ $movie->name }}</a>
                    </h3>
                    <span class="post-meta"><i class="fa fa-clock-o"></i>{{ $movie->release_year }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>