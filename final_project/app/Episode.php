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

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function watchStatuses()
    {
        return $this->belongsToMany(WatchStatus::class);
    }
}