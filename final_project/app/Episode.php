<?php

namespace App;

use App\Content;
use App\WatchStatus;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'content_id',
        'season',
        'number',
        'title',
        'trakt_id',
        'overview',
        'first_aired',
        'rating',
        'runtime'
    ];

    public function userWatched($user){
        //check if there is a watchstatus for a given episode
        //if yes return true
        //else return false
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function watchStatuses()
    {
        return $this->belongsToMany(WatchStatus::class);
    }
}
