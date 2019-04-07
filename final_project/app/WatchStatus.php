<?php

namespace App;

use App\Subscription;
use App\Episode;
use Illuminate\Database\Eloquent\Model;

class WatchStatus extends Model
{
  protected $fillable = [
    'subscription_id',
    'episode_trakt_id',
    'watched'
  ];

  public function subscription(){
      return $this->belongsTo(Subscription::class);
  }

  public function episode()
  {
    return $this->belongsTo(Episode::class, 'episode_trakt_id', 'trakt_id');
  }
}
