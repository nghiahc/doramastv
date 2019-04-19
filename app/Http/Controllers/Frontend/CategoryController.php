<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Repositories\MovieRepository;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use SEOMeta;
use OpenGraph;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Frontend
 */
class CategoryController extends Controller
{

    /**
     * @param Request         $request
     * @param                 $nameUrl
     * @param MovieRepository $movieRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $nameUrl, MovieRepository $movieRepository)
    {
        $movieType = $this->getIdFromNameUrl($nameUrl);
        $this->_addSeo(Movie::$movieTypes[$movieType]);

        $page = (int) $request->get('page');
        if (!$page) {
            $page = 1;
        }

        $agent = new Agent();
        $limit = $agent->isMobile() ? self::LIMIT_PER_PAGE_FOR_MOBILE : self::LIMIT_PER_PAGE;

        $offset    = ($page - 1) * $limit;
        $movies    = $movieRepository->fetchAllByMovieType($movieType, $offset, $limit);
        $total     = $movieRepository->getTotalByMovieType($movieType);
        $totalPage = (int) ceil($total / $limit);

        return view(
            'frontend.category.index',
            [
                'nameUrl'       => $nameUrl,
                'movieTypeName' => Movie::$movieTypes[$movieType],
                'movies'        => $movies,
                'current_page'  => $page,
                'pagination'    => $this->_buildPagination($page, $totalPage)
            ]
        );
    }

    /**
     * @param $nameUrl
     * @return string
     */
    protected function getIdFromNameUrl($nameUrl)
    {
        if (!preg_match('/\d+$/', $nameUrl, $outputId)) {
            return redirect()->route('frontend.errors.404');
        }

        return $outputId[0];
    }

    /**
     * @param $movieType
     */
    private function _addSeo($movieType)
    {
        SEOMeta::setTitleDefault($movieType);
        SEOMeta::setDescription($movieType);

        OpenGraph::setDescription($movieType);
        OpenGraph::setTitle("{$movieType} new | {$movieType} good | {$movieType} Online");
    }
}