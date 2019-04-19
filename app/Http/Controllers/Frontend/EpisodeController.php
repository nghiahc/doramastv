<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Repositories\EpisodeRepository;
use Illuminate\Http\Request;

/**
 * Class EpisodeController
 * @package App\Http\Controllers\Frontend
 */
class EpisodeController extends Controller
{
    /**
     * @param EpisodeRepository $episodeRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function top(EpisodeRepository $episodeRepository)
    {
        try {
            $results      = [];
            $episodes     = $episodeRepository->fetchNewEpisode(self::LIMIT_NEW_LIST);

            foreach ($episodes as $episode) {
                $results[] = [
                    'url'          => Episode::find($episode->id)->name_url,
                    'movie_name'   => $episode->title,
                    'episode_name' => "Episode {$episode->episode_name}",
                    'release_date' => $episode->release_date
                ];
            }

            return response()->json(
                [
                    'success' => true,
                    'data'    => $results
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }
}
