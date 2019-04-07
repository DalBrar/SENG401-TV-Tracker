<?php

namespace App\Http\Controllers;

use App\Content;
use App\Episode;
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
        "trakt-api-key: " . env('api_id')
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

    private function summary($traktId)
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
        $existing_content = Content::where('trakt_id', $content->trakt_id)->first();
        if (is_null($existing_content)) {
            Content::create([
                'trakt_id' => $content->trakt_id
            ]);

        }
        return $content;
    }
}
