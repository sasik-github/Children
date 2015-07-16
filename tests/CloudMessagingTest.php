<?php
/**
 * User: sasik
 * Date: 7/16/15
 * Time: 10:09 PM
 */

use Sasik\Google\CloudMessaging;

class CloudMessagingTest extends PHPUnit_Framework_TestCase {

    public function testSend()
    {
        $token = 'APA91bGi5JhZbR5DebXc5HzpcCHHk4Ct_3RBhQwwpxEntOG_nIHNgHvVNUO-SelCsY5s8f638uukDCYC3bxuPeXky0WeHWB8pXUFLB2E7Q5eLEvBp4vwPTU3lEknni9M6mv4VUP1W9iY';
        $resp = CloudMessaging::send($token);
        var_dump($resp);
        $this->assertEquals([], $resp);
    }
}
