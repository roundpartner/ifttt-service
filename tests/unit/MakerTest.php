<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Maker\Maker;

/**
 * Class MakerTest
 */
class MakerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Maker
     */
    protected $maker;

    /**
     * Set up tests
     */
    public function setUp()
    {
        $responseBody = "Congratulations! You've fired the example event";
        $response = new Response(200, [], $responseBody);
        $mock = new MockHandler([$response]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $maker = new Maker('anykey');
        $maker->setClient($client);
        $this->maker = $maker;
    }

    /**
     * Test trigger
     */
    public function testTrigger()
    {
        $this->assertTrue($this->maker->trigger('example'));
    }

}