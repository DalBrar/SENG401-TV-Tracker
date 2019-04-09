<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Episode;

class EpisodeController extends Controller
{
    public function show(Request $request)
    {
      $episode = new Episode();
      $episode->content_trakt_id = $request->input('content_trakt_id');
      $episode->trakt_id = $request->input('trakt_id');
      $episode->season = $request->input('season');
      $episode->number = $request->input('number');

      $ch = curl_init();

      curl_setopt($ch,
          CURLOPT_URL,
          "https://api.trakt.tv/shows/" . $episode->content_trakt_id . "/seasons/" . $episode->season . "/episodes/" . $episode->number . "?extended=full"
      );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);

      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json",
      "trakt-api-version: 2",
      "trakt-api-key: " . env('api_id')
      ));

      $response = curl_exec($ch);
      curl_close($ch);

      $jsonArray = json_decode($response, true);
      $episodes = [];

      $newepisode = new Episode([
          'content_trakt_id' => $episode->content_trakt_id,
          'season' => $jsonArray['season'],
          'number' => $jsonArray['number'],
          'title' => $jsonArray['title'],
          'trakt_id' => $jsonArray['ids']['trakt'],
          'overview' => $jsonArray['overview'],
          'runtime' => $jsonArray['runtime'],
          'first_aired' => $jsonArray['first_aired'],
          'rating' => $jsonArray['rating'],
      ]);
      array_push($episodes, $newepisode);
      $this->store($newepisode);

      return view('episodes.show', ['episodes' => $episodes, 'options' => ['hideEpisodesButton' => true]]);
    }

    public function store(Episode $episode)
    {
      $existing_episode = Episode::where('trakt_id', $episode->trakt_id)->first();
      if (is_null($existing_episode)) {
          Episode::create([
              'content_trakt_id' => $episode->content_trakt_id,
              'trakt_id' => $episode->trakt_id
          ]);

      }
    }
}
