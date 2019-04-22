<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int       $id
 * @property string    $name
 * @property string    $alternate_name
 * @property integer   $movie_type
 * @property string    $thumb_url
 * @property integer   $release_year
 * @property string    $description
 * @property float     $rating
 * @property string    $country
 * @property string    $genres
 * @property string    $trailer_url
 * @property string    $actors
 * @property string    $clone_url
 * @property string    $created_at
 * @property string    $updated_at
 * @property Episode[] $episodes
 */
class Movie extends Model
{
    const MOVIE_TYPE_DRAMA = 1;
    const MOVIE_TYPE_MOVIE = 2;
    const MOVIE_TYPE_OTHER = 3;

    public static $movieTypes = [
        self::MOVIE_TYPE_DRAMA => 'Drama',
        self::MOVIE_TYPE_MOVIE => 'Peliculas De Estreno'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'alternate_name',
        'movie_type',
        'thumb_url',
        'release_year',
        'description',
        'rating',
        'country',
        'genres',
        'trailer_url',
        'actors',
        'clone_url',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function episodes()
    {
        return $this->hasMany('App\Models\Episode');
    }

    /**
     * @return string
     */
    public function getNameUrlAttribute()
    {
        $regex              = '/[^a-zA-Z0-9\p{Han}\p{Hangul}\p{Hiragana}\p{Katakana}+]/u';
        $nonAsciiCleaned    = preg_replace($regex, ' ', trim(strtolower($this->name)));
        $multiSpacesCleaned = preg_replace('/\s+/m', ' ', $nonAsciiCleaned);
        $newTitle           = str_replace(' ', '-', trim($multiSpacesCleaned));

        return "{$newTitle}-{$this->id}";
    }

    /**
     * @return string
     */
    public function getTitleNonAsciiAttribute()
    {
        $regex              = '/[^a-zA-Z0-9\p{Han}\p{Hangul}\p{Hiragana}\p{Katakana}+]/u';
        $nonAsciiCleaned    = preg_replace($regex, ' ', trim(strtolower($this->name)));
        $multiSpacesCleaned = preg_replace('/\s+/m', ' ', $nonAsciiCleaned);

        return str_replace(' ', '-', trim($multiSpacesCleaned));
    }

}
