<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property int    $movie_id
 * @property string name
 * @property string source
 * @property string clone_url
 * @property string $created_at
 * @property string $updated_at
 * @property Movie  $movie
 */
class Episode extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'movie_id',
        'name',
        'source',
        'clone_url',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo('App\Models\Movie');
    }

    /**
     * @return string
     */
    public function getNameUrlAttribute()
    {
        $name = str_replace(' ', '-', strtolower(trim($this->name)));

        return "{$this->movie->title_non_ascii}-episode-{$name}-{$this->id}";
    }

}
