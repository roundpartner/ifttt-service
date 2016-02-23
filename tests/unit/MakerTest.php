<?php

/**
 * Class MakerTest
 */
class MakerTest extends PHPUnit_Framework_TestCase
{

    public function testTrigger()
    {
        $responseBody = "Congratulations! You've fired the roundpartner event";
        $response = new \GuzzleHttp\Psr7\Response(200, [], $responseBody);
        $mock = $this->getMockBuilder('Client')
            ->setMethods(['request'])
            ->getMock();
        $mock->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));

        $maker = new \Maker\Maker('anykey');
        $maker->setClient($mock);
        $this->assertTrue($maker->trigger('roundpartner'));
    }

}