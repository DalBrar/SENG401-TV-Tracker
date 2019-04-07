<?php

namespace App\Http\Controllers;

use App\Content;
use App\Episode;
use App\WatchStatus;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchStatusController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if(Auth::check()) {
      $user = Auth::user();
      $content = Content::where('trakt_id', $request->route('id'))->first();
      $subscription = $user->subscription_for_content($content);

      $existing_episode = Episode::where('trakt_id', $request->trakt_id)->first();
      if (is_null($existing_episode)) {
        Episode::create([
          'trakt_id' => $request->trakt_id,
          'content_trakt_id' => $content->trakt_id
        ]);
      }

      WatchStatus::create([
        'subscription_id' => $subscription->id,
        'episode_trakt_id' => $request->trakt_id,
        'watched' => true
      ]);

      \Session::flash('message', 'Episode Watched');
      return redirect()->back();
    }
  }

  /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      if(Auth::check()) {
        $episode = Episode::where('trakt_id', $request->trakt_id)->first();
        $subscription = Auth::user()->subscription_for_content($episode->content);
        $watchstatus = WatchStatus::where('subscription_id', $subscription->id)->where('episode_trakt_id', $request->trakt_id)->first();
        $watchstatus->watched = false;
        $watchstatus->save();
        \Session::flash('message', 'Episode Forgotten');
        return redirect()->back();
      }
    }
}
