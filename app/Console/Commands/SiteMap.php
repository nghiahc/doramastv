<?php

namespace App\Console\Commands;

use App\Models\Episode;
use App\Models\MasterCategory;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

/**
 * Class SiteMap
 * @package App\Console\Commands
 */
class SiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create google site map';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('SiteMap creating');

        try {
            // create new sitemap object
            $sitemap = App::make("sitemap");

            // add items to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');
            $sitemap->add(URL::to('/privacy-policy'), Carbon::now(), '1.0', 'daily');
            $sitemap->add(URL::to('/disclaimer'), Carbon::now(), '1.0', 'daily');
            $sitemap->add(URL::to('/404'), Carbon::now(), '1.0', 'daily');

            // add category
            $sitemap->add(URL::to('/category/drama-1'), Carbon::now(), '0.9', 'daily');
            $sitemap->add(URL::to('/category/movie-2'), Carbon::now(), '0.9', 'daily');

            $total = 6;

            $movies = Movie::all()->orderBy('updated_at', 'desc')->get();
            foreach ($movies as $movie) {
                $total++;
                $sitemap->add(URL::to('/movie/' . $movie->name_url), $movie->updated_at, '0.9', 'daily');
            }

            $episodes = Episode::all()->orderBy('updated_at', 'desc')->get();
            foreach ($episodes as $episode) {
                $total++;
                $sitemap->add(URL::to('/play/' . $episode->name_url), $episode->updated_at, '0.9', 'daily');
            }

            // generate your sitemap (format, filename)
            $sitemap->store('xml', 'sitemap');

            $this->line('Total SiteMap were created: ' . $total);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        $this->info('SiteMap done');

        return true;
    }
}
