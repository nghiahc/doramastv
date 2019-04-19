<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const LIMIT_PER_PAGE            = 15;
    const LIMIT_PER_PAGE_FOR_MOBILE = 12;
    const LIMIT_EPISODE_SHOW_WATCH  = 30;
    const LIMIT_HOME_PAGE           = 30;
    const LIMIT_NEW_LIST            = 10;

    /**
     * @param $page
     * @param $totalPage
     * @return array
     */
    protected function _buildPagination($page, $totalPage)
    {
        if ($totalPage <= 1) {
            return [];
        }

        $total   = 3;
        $results = [];
        if ($page == 1) {
            for ($i = 1; $i <= $total; $i++) {
                if ($i > $totalPage) {
                    continue;
                }

                $results[$i] = $i;
            }
            if ($i < $totalPage) {
                $results[$totalPage] = 'Last →';
            }
        }
        else {
            $results[1]  = '← First';
            $currentPage = $page - 1;
            do {
                $results[$currentPage] = $currentPage;
                $currentPage++;
            } while (($currentPage <= $totalPage) && ($currentPage < ($page - 1 + $total)));
            if ($currentPage < $totalPage) {
                $results[$totalPage] = 'Last →';
            }
        }

        return $results;
    }
}
