<?php

namespace App\Repositories;

use App\Models\Movie;

/**
 * Class MovieRepository
 * @package App\Repositories
 */
class MovieRepository
{
    /**
     * @var Movie
     */
    protected $model;

    /**
     * MovieRepository constructor.
     * @param Movie $movie
     */
    public function __construct(Movie $movie)
    {
        $this->model = $movie;
    }

    /**
     * @return Movie[]
     */
    public function fetchAll()
    {
        return $this
            ->model
            ->get();
    }

    /**
     * @param $id
     * @return Movie
     */
    public function fetchById($id)
    {
        return $this
            ->model
            ->where('id', $id)
            ->first();
    }

    /**
     * @param     $movieType
     * @return int
     */
    public function getTotalByMovieType($movieType)
    {
        return $this
            ->model
            ->where('movie_type', $movieType)
            ->get()
            ->count();
    }

    /**
     * @param     $movieType
     * @param int $offset
     * @param int $limit
     * @return Movie[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetchAllByMovieType($movieType, $offset = 0, $limit = 24)
    {
        return $this
            ->model
            ->where('movie_type', $movieType)
            ->orderBy('updated_at', 'DESC')
            ->orderBy('release_year', 'DESC')
            ->orderBy('id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    /**
     * @return array
     */
    public function fetchAllCompany()
    {
        return $this
            ->model
            ->select('company')
            ->where('is_active', 1)
            ->groupBy('company')
            ->orderBy('company', 'ASC')
            ->pluck('company')
            ->toArray();
    }

    /**
     * @return array
     */
    public function fetchAllCompanyByCategory($categoryId)
    {
        return $this
            ->model
            ->select('company')
            ->where('category_id', $categoryId)
            ->where('is_active', 1)
            ->groupBy('company')
            ->orderBy('company', 'ASC')
            ->pluck('company')
            ->toArray();
    }

    /**
     * @param      $categoryId
     * @param null $year
     * @param null $company
     * @param int  $offset
     * @param int  $limit
     * @return Movie[]|\Illuminate\Database\Eloquent\Collection
     */
    public function fetchAllByCondition(
        $categoryId,
        $year = null,
        $company = null,
        $offset = 0,
        $limit = 24
    ) {
        $query = $this
            ->model
            ->where('category_id', $categoryId)
            ->where('is_active', 1);
        if ($year) {
            $query->where('release_date', 'like', '%' . $year . '%');
        }
        if ($company) {
            $query->where('company', $company);
        }

        return $query
            ->orderBy('updated_at', 'DESC')
            ->orderBy('release_date', 'DESC')
            ->orderBy('id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    /**
     * @param     $keyword
     * @return int
     */
    public function getTotalByKeyword($keyword)
    {
        return $this
            ->model
            ->where('name', 'like', '%' . $keyword . '%')
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->count();
    }

    /**
     * @param     $keyword
     * @param int $offset
     * @param int $limit
     * @return Movie[]
     */
    public function fetchAllByKeyword($keyword, $offset = 0, $limit = 24)
    {
        return $this
            ->model
            ->where('name', 'like', '%' . $keyword . '%')
            ->orderBy('updated_at', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    /**
     * @param $ids
     * @return Movie[]
     */
    public function fetchByIds($ids)
    {
        return $this
            ->model
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param $limit
     * @return Movie[]
     */
    public function fetchTopByReleaseYearAndUpdatedAt($limit)
    {
        return $this
            ->model
            ->orderBy('updated_at', 'DESC')
            ->orderBy('release_year', 'DESC')
            ->orderBy('id', 'DESC')
            ->offset(0)
            ->limit($limit)
            ->get();
    }


    /**
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function fetchAllByPagination($offset = 0, $limit = 24)
    {
        return $this
            ->model
            ->orderBy('updated_at', 'DESC')
            ->orderBy('release_year', 'DESC')
            ->orderBy('id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function fetchTopEnded($limit)
    {
        return $this
            ->model
            ->orderBy('updated_at', 'DESC')
            ->orderBy('release_year', 'DESC')
            ->limit($limit)
            ->get();
    }
}
