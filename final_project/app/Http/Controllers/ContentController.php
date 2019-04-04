<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
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
        return $content;
    }
}