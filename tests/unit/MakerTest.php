<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Class MakerTest
 */
class MakerTest extends PHPUnit_Framework_TestCase
{

    public function testTrigger()
    {
        $responseBody = "Congratulations! You've fired the roundpartner event";
        $response = new Response(200, [], $responseBody);
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $maker = new \Maker\Maker('anykey');
        $maker->setClient($client);
        $this->assertTrue($maker->trigger('roundpartner'));
    }

}