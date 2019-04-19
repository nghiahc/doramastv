<div id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-3" id="logo">
                <a title="Doramastv.to - Ver doramas online" href="/">
                    <img src="{{ asset('img/frontend/logo.png') }}"
                         alt="Doramastv.to - Ver doramas online">
                </a>
            </div>
            <form id="form-search" method="get" action="{{ route('frontend.movie.search') }}">
                <div class="col-sm-6" id="header-search">
                    <span class="glyphicon glyphicon-search search-icon"></span>
                    <input value="" name="keyword" type="text" placeholder="Búscar..." id="keyword">
                </div>
            </form>

            {!! (string) Share
                ::currentPage('Doramastv.to Vea drama en línea, película asiática, drama asiático, descargue drama, descargue gratis, mejor película de transmisión.')
                ->facebook()
                ->twitter()
                ->googlePlus()
                ->linkedin()
                ->whatsapp() !!}
        </div>
    </div>

    @push('after-scripts')
        @include('frontend.includes.includes.search_js_script')
    @endpush
</div>
