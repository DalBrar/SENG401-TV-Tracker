<?php

namespace App;

use App\Content;
use App\WatchStatus;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = [
        'content_trakt_id',
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
        foreach ($this->watchStatuses as $watchStatus) {
            if ($watchStatus->subscription->user_id == $user->id) {
                if ($watchStatus->watched) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_trakt_id', 'trakt_id');
    }

    public function watchStatuses()
    {
        return $this->hasMany(WatchStatus::class, 'episode_trakt_id', 'trakt_id');
    }
}
