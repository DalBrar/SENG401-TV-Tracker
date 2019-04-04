<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WatchStatus;

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
      $user = User::all()->where('id', Auth::user()->id)->first();
      $episode = Episode::all()->where('id', $request->input('episode_id')->first();
      $watchstatus['user_id'] =  $user;
      $watchstatus['episode_id'] =  $episode;
      WatchStatus::create($watchstatus);
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
      if(Auth::check()){
        $watchstatus = WatchStatus::all->where('user_id', Auth::user()->id)->where('episode_id', $request->input('episode_id'))->first();
        $watchstatus->delete();
      }
    }
}
