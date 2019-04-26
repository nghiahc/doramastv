@if(!empty($sliderMovies))
    <div class="col-md-12">
        <div class="wpb_wrapper">
            <div id="myCarousel" class="carousel slide video-section"
                 data-ride="carousel">
                <div class="section-header">
                    <h3 class="widget-title"><i class="fa fa-play"></i> Películas Destacadas</h3>
                    <ol class="carousel-indicators section-nav">
                        @foreach($sliderMovies as $index => $movies)
                            <li data-target="#myCarousel" data-slide-to="{{ $index }}"
                                class="bullet {{ $index ? '' : 'active' }}"></li>
                        @endforeach
                    </ol>
                </div>

                <div class="latest-wrapper">
                    <div class="row">
                        <div class="carousel-inner">
                            @foreach($sliderMovies as $index => $movies)
                                <div class="item {{ $index ? '' : 'active' }}">
                                    @foreach($movies as $movie)
                                        <div class="col-md-4 col-sm-4 col-xs-12 item responsive-height post">
                                            <div class="item-img">
                                                <a title="Ver {{ $movie['name'] }}"
                                                   href="{{ $movie['url'] }}">
                                                    <img src="{{ $movie['image'] }}"
                                                         class="img-responsive wp-post-image" alt="">
                                                </a>
                                                <a href="{{ $movie['url'] }}">
                                                    <div class="img-hover"></div>
                                                </a>
                                            </div>
                                            <h3><a title="Ver {{ $movie['name'] }}"
                                                   href="{{ $movie['url'] }}">{{ $movie['name'] }}</a></h3>

                                            <div class="slider-info"><span>{{ $movie['country'] }}</span>
                                                <span>{{ $movie['genres'] }}</span>
                                                <span>{{ $movie['year'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        @include('frontend.includes.includes.slider_js_script')
    @endpush
@endif
