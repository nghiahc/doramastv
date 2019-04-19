<?php

namespace App\Helpers\General;

/**
 * Class Category
 * @package App\Helpers\General
 */
class Category
{

    /**
     * @return array
     */
    public function getCategoriesForNavigation()
    {
        return $this->buildCategories();
    }

    /**
     * @return array
     */
    private function buildCategories()
    {
        return [
            'home'      => [
                'name' => 'Inicio',
                'url'  => '/'
            ],
            'Drama'   => [
                'name' => 'Drama',
                'url'  => route('frontend.category.index', 'drama-1')
            ],
            'Movie'    => [
                'name' => 'Peliculas De Estreno',
                'url'  => route('frontend.category.index', 'movie-2')
            ]
        ];
    }
}
