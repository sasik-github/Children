<?php
/**
 * User: sasik
 * Date: 7/17/15
 * Time: 8:41 PM
 */

namespace Sasik\Google;


class Request {
    public static function send()
    {

        $data = array( 'message' => 'Hello World!' );

        $ids = array( 'abc', 'def' );

        $apiKey = APP_KEY;

        $url = 'https://android.googleapis.com/gcm/send';

        $post = array(
            'registration_ids'  => $ids,
            'data'              => $data,
        );

        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );

        $result = curl_exec( $ch );

        if ( curl_errno( $ch ) )
        {
            echo 'GCM error: ' . curl_error( $ch );
        }

        curl_close( $ch );

        return $result;
    }
}