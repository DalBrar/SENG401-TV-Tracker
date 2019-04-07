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
        return $this->hasMany(Subscription::class, 'content_trakt_id', 'trakt_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'content_trakt_id', 'trakt_id');
    }

    public function userSubscribed($user)
    {
        foreach ($this->subscriptions as $subscription) {
            if ($subscription->user_id == $user->id && $subscription->active) {
                return true;
            }
        }
        return false;
    }
}
