<div id="navigation-wrapper">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <!-- menu -->
            <ul id="menu-header-menu" class="nav navbar-nav list-inline menu">
                @foreach(getCategoriesForNavigation() as $category)
                    <li class="menu-item depth">
                        <a href="{{ $category['url'] }}" title="{{ $category['name'] }}">{{ $category['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>
