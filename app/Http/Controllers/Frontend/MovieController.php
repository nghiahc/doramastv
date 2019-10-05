<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Repositories\EpisodeRepository;
use App\Repositories\MovieRepository;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use SEOMeta;
use OpenGraph;

/**
 * Class MovieController
 * @package App\Http\Controllers\Frontend
 */
class MovieController extends Controller
{
    /**
     * @var MovieRepository
     */
    private $movieRepository;

    /**
     * @var EpisodeRepository
     */
    private $episodeRepository;

    /**
     * MovieController constructor.
     * @param MovieRepository   $movieRepository
     * @param EpisodeRepository $episodeRepository
     */
    public function __construct(MovieRepository $movieRepository, EpisodeRepository $episodeRepository)
    {
        $this->movieRepository   = $movieRepository;
        $this->episodeRepository = $episodeRepository;
    }

    /**
     * @param $titleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($titleId)
    {
        $movieId          = $this->getIdFromUrl($titleId);
        $movie            = $this->movieRepository->fetchById($movieId);
        $episode          = $this->episodeRepository->fetchFirstByMovieId($movieId);
        $episodeWatchList = $this->episodeRepository->fetchAllByMovieIdAndLimit(
            $movieId,
            self::LIMIT_EPISODE_SHOW_WATCH
        );
        if ($episode) {
            $isMovie = (count($movie->episodes) === 1) & ($episode->name == 0);
        }
        else {
            $isMovie = true;
        }

        $keywords     = array_map(
            function ($keyword) {
                return trim($keyword);
            },
            explode('-', trim($movie->title))
        );
        $keywords[]   = trim($movie->genres);
        $description  = 'Ver en linea ' . $keywords[0] . ', ' . SEOMeta::getDescription();
        $siteName     = env('SITE_NAME');
        $title        = "Ver {$movie->name} sin anuncios | {$siteName}";
        $categoryName = Movie::$movieTypes[$movie->movie_type];

        SEOMeta::setTitleDefault($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords(array_merge($keywords, SEOMeta::getKeywords()));

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::addImage($movie->thumb_url);

        return view(
            'frontend.movie.index',
            [
                'movie'            => $movie,
                'episode'          => $episode,
                'episodeWatchList' => $episodeWatchList,
                'isShowMore'       => $episode ? count($movie->episodes) > self::LIMIT_EPISODE_SHOW_WATCH : false,
                'isMovie'          => $isMovie,
                'tags'             => $this->buildTags($movie, $isMovie),
                'categoryName'     => $categoryName,
                'categoryUrl'      => route('frontend.category.index', "{$categoryName}-{$movie->movie_type}")
            ]
        );
    }

    /**
     * @param $episodeNameId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function play($episodeNameId)
    {
        $episodeId        = $this->getIdFromUrl($episodeNameId);
        $episode          = $this->episodeRepository->fetchById($episodeId);
        $movie            = $this->movieRepository->fetchById($episode->movie_id);
        $episodeWatchList = $this->episodeRepository->fetchAllByMovieIdAndLimit(
            $episode->movie_id,
            self::LIMIT_EPISODE_SHOW_WATCH
        );
        $isMovie          = (count($movie->episodes) === 1) & ($episode->name == 0);
        $lastEpisode      = $this->episodeRepository->fetchAllByMovieId($episode->movie_id)->last();
        $categoryName     = Movie::$movieTypes[$movie->movie_type];

        // build title
        $siteName = env('SITE_NAME');
        if ($isMovie) {
            $title = "Ver {$movie->name} sin anuncios | {$siteName}";
        }
        else {
            $title = "Ver {$movie->name} - Capítulo {$episode->name} sin anuncios | {$siteName}";
        }

        // build keywords
        $keywords   = array_map(
            function ($keyword) {
                return trim($keyword);
            },
            explode('-', trim($movie->name))
        );
        $keywords[] = trim($movie->genres);
        $keywords[] = $title;
        array_unshift($keywords, 'Ver en linea ' . $keywords[0], 'ver en linea gratis', 'descargar gratis');
        $description = implode(', ', $keywords) . ', ' . SEOMeta::getDescription();

        SEOMeta::setTitleDefault($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords(array_merge($keywords, SEOMeta::getKeywords()));

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::addImage($movie->thumb_url);

        $tags = $this->buildTags($movie, $isMovie, $episode->name, $lastEpisode->name);

        return view(
            'frontend.movie.play',
            [
                'title'            => $title,
                'movie'            => $movie,
                'episodeWatchList' => $episodeWatchList,
                'current_episode'  => $episode,
                'tags'             => $tags,
                'isMovie'          => $isMovie,
                'categoryName'     => $categoryName,
                'categoryUrl'      => route('frontend.category.index', "{$categoryName}-{$movie->movie_type}"),
                'hostingUrl'       => $this->fetchHostingListUrl(),
            ]
        );
    }

    /**
     * @param $episodeNameId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function video($episodeNameId)
    {
        $episodeId        = $this->getIdFromUrl($episodeNameId);
        $episode          = $this->episodeRepository->fetchById($episodeId);
        $movie            = $this->movieRepository->fetchById($episode->movie_id);
        $episodeWatchList = $this->episodeRepository->fetchAllByMovieIdAndLimit(
            $episode->movie_id,
            self::LIMIT_EPISODE_SHOW_WATCH
        );
        $isMovie          = (count($movie->episodes) === 1) & ($episode->name == 0);
        $lastEpisode      = $this->episodeRepository->fetchAllByMovieId($episode->movie_id)->last();
        $categoryName     = Movie::$movieTypes[$movie->movie_type];

        // build title
        $siteName = env('SITE_NAME');
        if ($isMovie) {
            $title     = "Ver {$movie->name} sin anuncios | {$siteName}";
            $videoName = $movie->name;
        }
        else {
            $title     = "Ver {$movie->name} - Capítulo {$episode->name} sin anuncios | {$siteName}";
            $videoName = $movie->name . ' - Capítulo ' . $episode->name;
        }

        // build keywords
        $keywords   = array_map(
            function ($keyword) {
                return trim($keyword);
            },
            explode('-', trim($movie->name))
        );
        $keywords[] = trim($movie->genres);
        $keywords[] = $title;
        array_unshift($keywords, 'Ver en linea ' . $keywords[0], 'ver en linea gratis', 'descargar gratis');
        $description = implode(', ', $keywords) . ', ' . SEOMeta::getDescription();

        SEOMeta::setTitleDefault($title);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords(array_merge($keywords, SEOMeta::getKeywords()));

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::addImage($movie->thumb_url);

        $tags = $this->buildTags($movie, $isMovie, $episode->name, $lastEpisode->name);

        return view(
            'frontend.movie.video',
            [
                'title'            => $title,
                'movie'            => $movie,
                'episodeWatchList' => $episodeWatchList,
                'current_episode'  => $episode,
                'videoSources'     => base64_encode($episode->source),
                'videoName'        => $videoName,
                'vastTag'          => '',
                'tags'             => $tags,
                'isMovie'          => $isMovie,
                'categoryName'     => $categoryName,
                'categoryUrl'      => route('frontend.category.index', "{$categoryName}-{$movie->movie_type}")
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $page    = (int) $request->get('page');
        if (!$page) {
            $page = 1;
        }

        $agent = new Agent();
        $limit = $agent->isMobile() ? self::LIMIT_PER_PAGE_FOR_MOBILE : self::LIMIT_PER_PAGE;

        $offset    = ($page - 1) * $limit;
        $total     = $this->movieRepository->getTotalByKeyword($keyword);
        $movies    = $this->movieRepository->fetchAllByKeyword($keyword, $offset, $limit);
        $totalPage = (int) ceil($total / $limit);

        return view(
            'frontend.movie.search',
            [
                'pagination'   => $this->_buildPagination($page, $totalPage),
                'movies'       => $movies,
                'current_page' => $page,
                'keyword'      => $keyword
            ]
        );
    }

    /**
     * @param $url
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function getIdFromUrl($url)
    {
        if (!preg_match('/\d+$/', $url, $outputId)) {
            return redirect()->route('frontend.errors.404');
        }

        return $outputId[0];
    }

    /**
     * @param Movie  $movie
     * @param bool   $isMovie
     * @param string $episodeName
     * @param string $latEpisodeName
     * @return array
     */
    protected function buildTags(Movie $movie, $isMovie = true, $episodeName = '', $latEpisodeName = '')
    {
        $tags = [
            trim($movie->name),
            trim($movie->alternate_name)
        ];

        if (!$isMovie) {
            if ($episodeName) {
                $tags[] = "{$movie->name} capítulo {$episodeName}";
                $tags[] = "{$movie->name} cap {$episodeName}";
            }
            else {
                $tags[] = $movie->name . ' capítulo 1';
                $tags[] = $movie->name . ' cap 1';
            }
        }

        $tags[] = $movie->name . " {$movie->release_date}";
        $tags[] = $movie->name . ' spanish subtitular';
        $tags[] = 'ver en linea ' . $movie->name;
        $tags[] = 'descargar ' . $movie->name;

        $tags[] = Movie::$movieTypes[$movie->movie_type];

        if (trim($movie->genre)) {
            $genres = explode(',', trim($movie->genre));
            foreach ($genres as $genre) {
                $tags[] = trim($genre) . ' peliculas de estreno';
            }
            foreach ($genres as $genre) {
                $tags[] = trim($genre) . " {$movie->country} peliculas de estreno";
            }
            foreach ($genres as $genre) {
                $tags[] = trim($genre) . " {$movie->country} drama";
            }
        }

        $actors = explode(',', trim($movie->actors));
        foreach ($actors as $actor) {
            if (trim($actor)) {
                $tags[] = trim($actor);
            }
        }

        $year      = date('Y');
        $otherTags = "Vea drama en línea, película asiática, drama asiático, descargue drama, descargue gratis, mejor película de transmisión {$year}";
        $otherTags = explode(',', $otherTags);
        foreach ($otherTags as $otherTag) {
            $tags[] = trim($otherTag);
        }

        if ($latEpisodeName && !$isMovie) {
            $tags[] = "{$movie->name} capítulo {$latEpisodeName}";
            $tags[] = "{$movie->name} cap {$latEpisodeName}";
        }

        $results = [];
        foreach ($tags as $tag) {
            $results[preg_replace('/\s+/', '-', $tag)] = $tag;
        }

        return $results;
    }

    /**
     * @return string
     */
    private function fetchHostingListUrl()
    {
        $baseUrl = env('HOSTING_RANK_URL');

        $paths = [
            'cheap-web-hosting/',
            'how-we-rank-web-hosts/',
            'resources/',
            'website-builders/',
            'advertiser-disclosure/',
            'terms-of-usage/',
            'privacy-policy/',
            'about/',
            'reviews/bluehost/',
            'reviews/hostgator-cloud/',
        ];

        return $baseUrl . $paths[array_rand($paths)];
    }
}
