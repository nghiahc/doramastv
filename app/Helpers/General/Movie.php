<?php

namespace App\Helpers\General;

use App\Models\Episode;
use App\Repositories\EpisodeRepository;
use App\Repositories\MovieRepository;

/**
 * Class Movie
 * @package App\Helpers\General
 */
class Movie
{
    /**
     * @var MovieRepository
     */
    protected $movieRepository;

    /**
     * @var EpisodeRepository
     */
    protected $episodeRepository;

    /**
     * Movie constructor.
     * @param MovieRepository   $movieRepository
     * @param EpisodeRepository $episodeRepository
     */
    public function __construct(MovieRepository $movieRepository, EpisodeRepository $episodeRepository)
    {
        $this->movieRepository   = $movieRepository;
        $this->episodeRepository = $episodeRepository;
    }

    /**
     * @return array
     */
    public function getNewEpisodesForSidebar()
    {
        $results = [];

        try {
            $episodes = $this->episodeRepository->fetchNewEpisode(8);

            foreach ($episodes as $episode) {
                $title     = $episode->episode_name == 0 ? $episode->movie_name : "{$episode->movie_name} - Cap {$episode->episode_name}";
                $name      = $episode->episode_name == 0 ? $episode->movie_name : "[Cap {$episode->episode_name}] {$episode->movie_name}";
                $results[] = [
                    'url'          => Episode::find($episode->id)->name_url,
                    'title'        => $title,
                    'name'         => $name,
                    'release_date' => $episode->release_date,
                    'thumb_url'    => $episode->thumb_url,
                ];
            }

            return $results;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return array|mixed
     */
    public function getNewMoviesForSidebar()
    {
        try {
            return $this->movieRepository->fetchTopEnded(8);
        } catch (\Exception $e) {
            return [];
        }
    }
}
