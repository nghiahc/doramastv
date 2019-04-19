<?php

use App\Models\Episode;
use App\Models\MasterCategory;
use App\Models\Movie;
use Carbon\Carbon;

Route::get(
    'mysitemap',
    function () {

        // create new sitemap object
        $sitemap = App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');

        // get all category from db
        $categories = MasterCategory::all()->sortBy('updated_at', SORT_DESC);

        // add every category to the sitemap
        foreach ($categories as $category) {
            $sitemap->add(URL::to('/category/' . $category->name_url), $category->updated_at, '0.9', 'daily');
        }

        $movies = Movie::where('is_active', 1)->orderBy('updated_at', 'desc')->get();
        foreach ($movies as $movie) {
            $sitemap->add(URL::to('/movie/' . $movie->name_url), $movie->updated_at, '0.9', 'daily');
        }

        $episodes = Episode::where('is_active', 1)->orderBy('updated_at', 'desc')->get();
        foreach ($episodes as $episode) {
            $sitemap->add(URL::to('/play/' . $episode->name_url), $episode->updated_at, '0.9', 'daily');
        }

        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        // this will generate file sitemap.xml to your public folder

    }
);
