<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Http\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$user = Auth::user()->id;
		$subs = Subscription::where('user_id', $user)->get('content_trakt_id');
		
		$shows = array();
		foreach ($subs as $sub) {
			$id = $sub->content_trakt_id;
			$shows[$id] = app('App\Http\Controllers\ContentController')->summary($id);
			$shows[$id]['nextEpisode'] = app('App\Http\Controllers\ContentController')->nextEpisode($id);
		}
		
        return view('home', ['shows' => $shows]);
    }
}
