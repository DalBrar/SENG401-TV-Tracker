<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WatchStatus;
use App\Episode;
use App\Subscription;
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
    if(Auth::check()){
      // TODO: get the subscription_id
      $episode = Episode::all()->where('trakt_id', $request->input('trakt_id'))->first();
      $subscription = Subscription::all()->where('user_id', Auth::user()->id)->where('content_trakt_id', $request->input('content_trakt_id'))->first();
      $watchstatus['subscription_id'] = $subscription->id;
      $watchstatus['episode_trakt_id'] =  $episode->trakt_id;
      $watchstatus['watched'] =  true;
      WatchStatus::create($watchstatus);
    }

    return redirect()->route('watchstatus.store', ['id' => $episode->content_trakt_id]);
  }

  /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      if(Auth::check()){
        $subscription = Subscription::all()->where('user_id', Auth::user()->id)->where('content_trakt_id', $request->input('content_trakt_id'))->first();
        $watchstatus = WatchStatus::all()->where('episode_trakt_id', $request->input('trakt_id'))->where('subscription_id', $subscription->id)->first();
        $watchstatus->delete();
      }
      return redirect()->route('watchstatus.store', ['id' => $request->input('content_trakt_id')]);
    }
}
