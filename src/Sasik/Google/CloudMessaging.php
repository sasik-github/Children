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

    /**
     * @param $toToken
     * @param $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    public static function send($toToken, $data)
    {
        $client = new Client([
            'base_uri' => 'https://gcm-http.googleapis.com/gcm/send',
        ]);
        $response = $client->post('', [
            'headers' => [
                'Authorization' => 'key=' . CloudMessaging::APP_KEY,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'registration_ids' => [$toToken],
                'data' => $data,
            ],
            'http_errors' => false,
        ]);


//        var_dump([
//            $response->getStatusCode(),
//            json_decode($response->getBody()->getContents(), true)
//        ]);

        return $response;
    }
}