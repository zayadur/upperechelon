<?php

namespace PixieHuge;

use Alaouy\Youtube\Youtube;

class Stream
{

	public function parseStreamURI($uri) {

        $parsed = parse_url($uri);

        if(empty($parsed['path'])) {
            return NULL;
        }

        $temp = explode('/', $parsed['path']);
        return "{$temp[1]}";
    }


	public function getYoutubeChannel($uri, $apiKey) {
		$youtube = new Youtube($apiKey);
		$user = $youtube->getChannelFromURL($uri);

		if(!$user) {
			return esc_html__('Wrong youtube URL', 'pixiehugepanel');
		}
		$userData = [
			'snippet' => $user->snippet,
			'id'    => $user->id
		];
		return $userData;
	}
	public function getStream($uri, $type, $clientid = null) {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		if($type == 'twitch') {
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Client-ID: ' . $clientid));
		}
		curl_setopt($curl, CURLOPT_HEADER, false);

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		if($type == 'twitch') {
			$uri = 'https://api.twitch.tv/kraken/channels/' . $uri;
		} elseif($type == 'mixer') {
			$uri = 'https://mixer.com/api/v1/channels/' . $uri;
		}
		curl_setopt($curl, CURLOPT_URL, $uri);
		$response = curl_exec($curl);

		if(curl_errno($curl)) {
			$response = json_encode(['error' => true, 'message' => curl_error($curl)]);
		}
		curl_close($curl);
		return $response;
	}

}