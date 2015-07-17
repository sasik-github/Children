<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 9:59 PM
 */

namespace Sasik\Google;


use GuzzleHttp\Client;

class CloudMessaging {

    const APP_KEY = APP_KEY;

    public static function send($toToken, $data)
    {
        $client = new Client([
            'base_uri' => 'https://gcm-http.googleapis.com/gcm/send',
        ]);

        $response = $client->get('', [
            'headers' => [
                'Authorization' => 'key=' . CloudMessaging::APP_KEY,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'to' => $toToken,
                'data' => $data,
            ],
        ]);

        return $response;
    }
}