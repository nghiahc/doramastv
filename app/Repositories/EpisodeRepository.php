<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class EpisodeRepository
 * @package App\Repositories
 */
class EpisodeRepository
{
    /**
     * @var Episode
     */
    protected $model;

    /**
     * EpisodeRepository constructor.
     * @param Movie $episode
     */
    public function __construct(Episode $episode)
    {
        $this->model = $episode;
    }

    /**
     * @return Episode[]
     */
    public function fetchAll()
    {
        return $this
            ->model
            ->all();
    }

    /**
     * @param $id
     * @return Episode
     */
    public function fetchById($id)
    {
        return $this
            ->model
            ->where('id', $id)
            ->first();
    }

    /**
     * @param $movieId
     * @return Collection
     */
    public function fetchAllByMovieId($movieId)
    {
        return $this
            ->model
            ->where('movie_id', $movieId)
            ->orderByRaw('name + 0 ASC')
            ->get();
    }

    /**
     * @param $movieId
     * @return Collection
     */
    public function fetchAllByMovieIdAndLimit($movieId, $limit)
    {
        return $this
            ->model
            ->where('movie_id', $movieId)
            ->orderByRaw('name + 0 ASC')
            ->limit($limit)
            ->get();
    }

    /**
     * @param $id
     * @return Episode
     */
    public function fetchFirstByMovieId($movieId)
    {
        return $this
            ->model
            ->where('movie_id', $movieId)
            ->orderByRaw('name + 0 ASC')
            ->first();
    }

    /**
     * @param $limit
     * @return array
     */
    public function fetchMovieTop($limit)
    {
        return $this
            ->model
            ->select('movie_id', 'created_at')
            ->groupBy('movie_id')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->pluck('movie_id')
            ->toArray();
    }

    /**
     * @param $id
     * @return Episode
     */
    public function fetchLastByMovieId($movieId)
    {
        return $this
            ->model
            ->where('movie_id', $movieId)
            ->orderBy('name', 'DESC')
            ->first();
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function fetchNewEpisode($limit)
    {
        return DB::select(
            "SELECT DISTINCT
                e.movie_id,
                m.thumb_url,
                MAX(e.id) as id,
                e.name as episode_name,
                m.name as movie_name,
                DATE_FORMAT(e.updated_at, \"%Y-%m-%d\") as release_date
            FROM
                episodes e, movies m
            WHERE
                CONCAT(e.updated_at, e.name) IN (SELECT 
                        MAX(CONCAT(updated_at, name))
                    FROM
                        episodes
                    WHERE name != 0
                    GROUP BY movie_id)
                AND e.movie_id = m.id
            GROUP BY e.movie_id
            ORDER BY e.updated_at DESC, e.name + 0 DESC, e.movie_id DESC
            LIMIT {$limit};"
        );
    }
}
