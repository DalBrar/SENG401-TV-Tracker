<?php
        $ch = curl_init();

        curl_setopt($ch,
            CURLOPT_URL,
            //"https://api.trakt.tv/shows/1390?extended=full"
			//"https://api.trakt.tv/shows/1390/seasons/0/episodes/1?extended=full"
			"https://api.trakt.tv/shows/1390/seasons?extended=episodes"
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "trakt-api-version: 2",
        "trakt-api-key: be6647336f35bca684be0d9bbd3267ccfcb251ced33120eb920102e8e7a3602e"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
		
		echo $response;
?>