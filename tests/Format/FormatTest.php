<?php

namespace PositionalData\Tests\Format;

use PositionalData\Format\AbstractFormat;
use PositionalData\Format\FormatInterface;

class FormatTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var AbstractFormat
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = $this->getMockForAbstractClass('PositionalData\Format\AbstractFormat');
        $this->object
            ->expects($this->any())
            ->method('convert')
            ->with($this->stringContains('asd'))
            ->will($this->returnValue('ASD'));
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testSetAndGetFillWith()
    {
        $this->object->setFillWith(' ');
        $this->assertEquals(' ', $this->object->getFillWith());

        $this->object->setFillWith('0');
        $this->assertEquals('0', $this->object->getFillWith());
    }

    /**
     * @expectedException \PositionalData\Format\Exception\FormatException
     */
    public function testSetAndGetFillOn()
    {
        $this->object->setFillOn(FormatInterface::FILL_ON_RIGHT);
        $this->assertEquals(STR_PAD_RIGHT, $this->object->getFillOn());

        $this->object->setFillOn(FormatInterface::FILL_ON_LEFT);
        $this->assertEquals(STR_PAD_LEFT, $this->object->getFillOn());

        $this->object->setFillOn(FormatInterface::FILL_ON_BOTH);
        $this->assertEquals(STR_PAD_BOTH, $this->object->getFillOn());

        $this->object->setFillOn(5);
    }

    public function testSetAndGetLength()
    {
        $this->object->setLength(10);
        $this->assertEquals(10, $this->object->getLength());
    }

    public function testSimpleApply()
    {
        $this->assertEquals('ASD', $this->object->apply('asd'));
    }

    public function testApplyFillOnRightWithBlankFill()
    {
        $this->object
            ->setFillOn(FormatInterface::FILL_ON_RIGHT)
            ->setFillWith(' ')
            ->setLength(4);
        $this->assertEquals('ASD ', $this->object->apply('asd'));
    }

    public function testApplyFillOnLeftWithBlankFill()
    {
        $this->object
            ->setFillOn(FormatInterface::FILL_ON_LEFT)
            ->setFillWith(' ')
            ->setLength(4);
        $this->assertEquals(' ASD', $this->object->apply('asd'));
    }

    public function testApplyFillOnBothWithPairLengthAndBlankFill()
    {
        $this->object
            ->setFillOn(FormatInterface::FILL_ON_BOTH)
            ->setFillWith(' ')
            ->setLength(4);
        $this->assertEquals('ASD ', $this->object->apply('asd'));
    }

    public function testApplyFillOnBothWithOddLengthAndBlankFill()
    {
        $this->object
            ->setFillOn(FormatInterface::FILL_ON_BOTH)
            ->setFillWith(' ')
            ->setLength(5);
        $this->assertEquals(' ASD ', $this->object->apply('asd'));
    }
}