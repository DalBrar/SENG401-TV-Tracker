<?php

namespace App;

use App\Subscription;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'title',
        'year',
        'trakt_id',
        'overview',
        'runtime',
        'certification',
        'country',
        'rating',
        'language'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}