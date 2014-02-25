<?php

namespace PositionalData\Tests\Format;

use PositionalData\Format\StringFormat;

class StringFormatTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var StringFormat
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new StringFormat();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testGetDefaultData()
    {
        $this->assertEquals(' ', $this->object->getFillWith());
        $this->assertEquals(StringFormat::FILL_ON_RIGHT, $this->object->getFillOn());
    }

    public function testApplyWhenStringIsGiven()
    {
        $this->assertTrue('text' === $this->object->apply('text'));
    }

    public function testApplyWhenFloatIsGiven()
    {
        $this->assertTrue('1.5' === $this->object->apply(1.5));
    }

    public function testApplyWhenDefinedLength()
    {
        $this->object->setLength(5);
        $this->assertTrue('text ' === $this->object->apply('text'));
    }

    /**
     * @expectedException \PositionalData\Format\Exception\ConvertionException
     */
    public function testErrorWhenAnObjectIsGiven()
    {
        $this->object->apply(new \stdClass());
    }

    /**
     * @expectedException \PositionalData\Format\Exception\ConvertionException
     */
    public function testErrorWhenAnArrayIsGiven()
    {
        $this->object->apply(array());
    }
}