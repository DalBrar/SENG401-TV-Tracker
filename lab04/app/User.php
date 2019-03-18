<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'birthday', 'education'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'account_created_at' => 'datetime',
    ];

    public function subscriptions() {
        return $this->hasMany('App\Subscription');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function subscribedBooks()
    {
        $books = [];
        foreach($this->subscriptions as $subscription) {
            array_push($books, $subscription->book);
        }
        return $books;
    }

    public function subscribedToBook($book)
    {
        foreach($this->subscriptions as $subscription) {
            if ($subscription->book_id == $book->id)
                return true;
        }
        return false;
    }
}
