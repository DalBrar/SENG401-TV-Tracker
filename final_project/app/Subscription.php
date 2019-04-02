<?php

namespace App;

use App\User;
use App\WatchStatus;
use App\Content;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  protected $fillable = [
    'user_id',
    'content_id',
    'status'
  ];

  public function content(){
      return $this->belongsTo(Content::class);
  }

  public function watchStatus(){
      return $this->hasMany(WatchStatus::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
