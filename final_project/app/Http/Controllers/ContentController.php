<?php

namespace App\Http\Controllers;

use App\Content;
use App\Episode;
use App\Subscription;
use App\WatchStatus;
use App\Http\EpisodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function show($trakt_id)
    {
        $content = $this->summary($trakt_id);
		
        $ch = curl_init();

        curl_setopt($ch,
            CURLOPT_URL,
            "https://api.trakt.tv/shows/" . $content->trakt_id . "/seasons?extended=episodes"
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "trakt-api-version: 2",
        "trakt-api-key: " . env('API_ID')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $jsonArray = json_decode($response, true);
        $episodes = [];

        foreach ($jsonArray as $seasonJson) {
            foreach ($seasonJson['episodes'] as $episodeJson) {
                $episode = new Episode([
                    'content_trakt_id' => $trakt_id,
                    'season' => $episodeJson['season'],
                    'number' => $episodeJson['number'],
                    'title' => $episodeJson['title'],
                    'trakt_id' => $episodeJson['ids']['trakt'],
                ]);
                array_push($episodes, $episode);
				app('App\Http\Controllers\EpisodeController')->store($episode);
            }
        }

        return view('contents.show', ['content' => $content, 'episodes' => $episodes, 'options' => ['hideEpisodesButton' => true]]);
    }

    public function popular(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch,
            CURLOPT_URL,
            "https://api.trakt.tv/shows/popular"
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "trakt-api-version: 2",
        "trakt-api-key: " . env('API_ID')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $jsonArray = json_decode($response, true);
        $contents = [];
        foreach($jsonArray as $item) {
            $traktId = $item['ids']['trakt'];
            $content = $this->summary($traktId);
            array_push($contents, $content);
        }

        return view('contents.popular', ['contents' => $contents]);

    }

    public function search(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch,
            CURLOPT_URL,
            "https://api.trakt.tv/search/show?query=" . urlencode($request->query('q'))
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "trakt-api-version: 2",
        "trakt-api-key: " . env('API_ID')
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $jsonArray = json_decode($response, true);

        $contents = [];
        foreach($jsonArray as $item) {
            $traktId = $item['show']['ids']['trakt'];
            $content = $this->summary($traktId);
            array_push($contents, $content);
        }

        return view('contents.popular', ['contents' => $contents]);
    }

    public function summary($traktId)
    {
        $ch = curl_init();

        curl_setopt($ch,
            CURLOPT_URL,
            "https://api.trakt.tv/shows/" . $traktId . "?extended=full"
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "trakt-api-version: 2",
        "trakt-api-key: " . env('API_ID')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $jsonObject = json_decode($response, true);
        $content = new Content($jsonObject);
        $content->trakt_id = $traktId;
		
		// Calculate unwatched episodes
		$userId = Auth::user()->id;
		$subs = Subscription::where([
				['user_id', '=', $userId],
				['content_trakt_id', '=', $traktId]
			])->get();
		if (count($subs) != 0) {
			$subId = Subscription::where([
				['user_id', '=', $userId],
				['content_trakt_id', '=', $traktId]
			])->get('id')->first()->id;
			$e_watched = WatchStatus::where('subscription_id', $subId)->count();
			$e_total = $jsonObject['aired_episodes'];
			
			$e_unwatched = intval($e_total) - intval($e_watched);
			if ($e_unwatched > 0)
				$content->num_eps = $e_unwatched;
		}
		
		// create season-episode string
		$ad = $jsonObject['airs']['day'];
		$at = $jsonObject['airs']['time'];
		if (is_null($ad) || is_null($at))
			$content->airson = "Not Available";
		else
			$content->airson = $ad ."s at ". $at;
		
        $existing_content = Content::where('trakt_id', $content->trakt_id)->first();
        if (is_null($existing_content)) {
            Content::create([
                'trakt_id' => $content->trakt_id
            ]);

        }
        return $content;
    }
	
	public function nextEpisode($traktId)
	{
        $ch = curl_init();

        curl_setopt($ch,
            CURLOPT_URL,
            "https://api.trakt.tv/shows/" . $traktId . "/next_episode"
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "trakt-api-version: 2",
        "trakt-api-key: " . env('API_ID')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $ep = json_decode($response, true);
		$s = $ep['season'];
		$e = $ep['number'];
		if (is_null($s) || is_null($e))
			$nextEpisode = "Not Available";
		else
			$nextEpisode = "s". $s ."e". $e;
		
        return $nextEpisode;
	}
}
