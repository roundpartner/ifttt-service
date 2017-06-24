<?php

namespace RoundPartner\Test;

use RoundPartner\Maker\RequestFactory;

class RequestFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RoundPartner\Maker\Entity\Request
     */
    protected $request;

    public function setUp()
    {
        $this->request = RequestFactory::factory('aaa', 'bbb', 'ccc', 'ddd');
    }

    public function testCreateRequest()
    {
        $this->assertInstanceOf('\RoundPartner\Maker\Entity\Request', $this->request);
    }

    public function testEventValue()
    {
        $this->assertEquals('aaa', $this->request->event);
    }

    public function testValueOne()
    {
        $this->assertEquals('bbb', $this->request->value1);
    }

    public function testValueTwo()
    {
        $this->assertEquals('ccc', $this->request->value2);
    }

    public function testValueThree()
    {
        $this->assertEquals('ddd', $this->request->value3);
    }
}
