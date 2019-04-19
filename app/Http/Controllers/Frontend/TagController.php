<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\MovieRepository;
use Illuminate\Http\Request;

/**
 * Class TagController
 * @package App\Http\Controllers\Frontend
 */
class TagController extends Controller
{
    const LIMIT_PER_PAGE = 15;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($tag, Request $request, MovieRepository $movieRepository)
    {
        $page = (int) $request->get('page');
        if (!$page) {
            $page = 1;
        }

        $offset    = ($page - 1) * self::LIMIT_PER_PAGE;
        $movies    = $movieRepository->fetchAllByPagination($offset, self::LIMIT_PER_PAGE);
        $total     = count($movieRepository->fetchAll());
        $totalPage = (int) ceil($total / self::LIMIT_PER_PAGE);

        return view(
            'frontend.tag.index',
            [
                'pagination'   => $this->_buildPagination($page, $totalPage),
                'movies'       => $movies,
                'current_page' => $page,
                'tag'          => $tag
            ]
        );
    }
}