<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\MovieRepository;

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends Controller
{
    /**
     * @param MovieRepository $movieRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(MovieRepository $movieRepository) {
        return view(
            'frontend.index',
            [
                'movies' => $movieRepository->fetchTopByReleaseYearAndUpdatedAt(self::LIMIT_HOME_PAGE)
            ]
        );
    }
}
