<?php

namespace EletronicData\Tests\Format;

use EletronicData\Format\IntegerFormat;

class IntegerFormatTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var IntegerFormat
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new IntegerFormat();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testGetDefaultData()
    {
        $this->assertEquals('0', $this->object->getFillWith());
        $this->assertEquals(IntegerFormat::FILL_ON_LEFT, $this->object->getFillWith());
    }

    public function testApplyWhenIntegerIsGiven()
    {
        $this->assertEquals('1', $this->object->apply(1));
    }

    public function testApplyWhenFloatIsGiven()
    {
        $this->assertEquals('1', $this->object->apply(1.5));
    }

    public function testApplyWhenDoubleIsGiven()
    {
        $this->assertEquals('1', $this->object->apply(1.8));
    }

    public function testApplyWhenDefinedLength()
    {
        $this->object->setLength(5);
        $this->assertEquals('00001', $this->object->apply(1));
    }

    /**
     * @expectedException \EletronicData\Format\Exception\ConvertionException
     */
    public function testErrorWhenAStringIsGiven()
    {
        $this->object->apply('text');
    }

    /**
     * @expectedException \EletronicData\Format\Exception\ConvertionException
     */
    public function testErrorWhenAnObjectIsGiven()
    {
        $this->object->apply(new \stdClass());
    }

    /**
     * @expectedException \EletronicData\Format\Exception\ConvertionException
     */
    public function testErrorWhenAnArrayIsGiven()
    {
        $this->object->apply(array());
    }
}