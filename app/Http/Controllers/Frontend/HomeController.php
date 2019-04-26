<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\MovieRepository;
use App\Services\GoogleSheetsService;

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends Controller
{
    /**
     * @param MovieRepository     $movieRepository
     * @param GoogleSheetsService $googleSheetsService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(MovieRepository $movieRepository, GoogleSheetsService $googleSheetsService)
    {
        $sliderMovieList = [];
        $sliderMovies    = $googleSheetsService->coverMovies();
        $sliderIndex     = 0;
        foreach ($sliderMovies as $index => $sliderMovie) {
            if (!$sliderMovie['image']) {
                continue;
            }
            $sliderMovieList[$sliderIndex][] = $sliderMovie;
            if ($index % 3 === 2) {
                $sliderIndex++;
            }
        }

        return view(
            'frontend.index',
            [
                'sliderMovies' => $sliderMovieList,
                'movies'       => $movieRepository->fetchTopByReleaseYearAndUpdatedAt(self::LIMIT_HOME_PAGE)
            ]
        );
    }
}
