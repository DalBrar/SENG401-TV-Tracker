<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $fillable = [
    'name',
    'isbn',
    'publication_year',
    'publisher',
    'subscription_status',
    'image'
  ];

  public function authors()
  {
    return $this->belongsToMany('App\Author');
  }

  public function subscriptions() {
    return $this->hasMany('App\Subscription');
  }

  public function comments() {
    return $this->hasMany('App\Comment');
  }

  public function authorNames()
  {
    $i = 0;
    $len = count($this->authors);

    $authorsString = '';
    foreach ($this->authors as $key => $author) {
      $authorsString .= $author->name;
      if ($i != $len - 1)
        $authorsString .= ', ';
      $i++;
    }
    return $authorsString;
  }

  public function hasSubscription() {
    return (bool) $this->subscriptions->first();
  }

  public function hasComments() {
    return (bool) $this->comments->first();
  }

  public function userSubscribed($user) {
    foreach($this->subscriptions as $subscription) {
      if ($subscription->user_id == $user->id)
        return true;
    }
    return false;
  }
}
