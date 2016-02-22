<?php

/**
 * Class MakerTest
 */
class MakerTest extends PHPUnit_Framework_TestCase
{

    public function testTrigger()
    {
        $response = new \GuzzleHttp\Psr7\Response();
        $mock = $this->getMockBuilder('Client')
            ->setMethods(['request'])
            ->getMock();
        $mock->expects($this->any())
            ->method('request')
            ->will($this->returnValue($response));


        $maker = new \Maker\Maker();
        $maker->setClient($mock);
        $this->assertTrue($maker->trigger('myevent', 'anyapikeyiwant'));
    }

}