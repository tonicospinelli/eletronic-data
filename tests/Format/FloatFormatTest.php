<?php

namespace PositionalData\Tests\Format;

use PositionalData\Format\FloatFormat;

class FloatFormatTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var FloatFormat
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new FloatFormat();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetDecimalPoint()
    {
        $this->object->setDecimalPoint('.');
        $this->assertEquals('.', $this->object->getDecimalPoint());

        $this->object->setDecimalPoint(',');
        $this->assertEquals(',', $this->object->getDecimalPoint());

        $this->object->setDecimalPoint(FloatFormat::SEPARATOR_COMMA);
        $this->assertEquals(',', $this->object->getDecimalPoint());

        $this->object->setDecimalPoint(FloatFormat::SEPARATOR_DOT);
        $this->assertEquals('.', $this->object->getDecimalPoint());

        $this->object->setDecimalPoint('-');
    }

    public function testSetAndGetDecimalLength()
    {
        $this->object->setDecimalLength(2);
        $this->assertEquals(2, $this->object->getDecimalLength());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetThousandsSeparator()
    {
        $this->object->setThousandsSeparator('.');
        $this->assertEquals('.', $this->object->getThousandsSeparator());

        $this->object->setThousandsSeparator(',');
        $this->assertEquals(',', $this->object->getThousandsSeparator());

        $this->object->setThousandsSeparator(FloatFormat::SEPARATOR_COMMA);
        $this->assertEquals(',', $this->object->getThousandsSeparator());

        $this->object->setThousandsSeparator(FloatFormat::SEPARATOR_DOT);
        $this->assertEquals('.', $this->object->getThousandsSeparator());

        $this->object->setThousandsSeparator('-');
    }

    public function testGetDefaultData()
    {
        $this->assertEquals('.', $this->object->getDecimalPoint());
        $this->assertEquals(',', $this->object->getThousandsSeparator());
    }

    public function testApplyWhenIntegerIsGiven()
    {
        $this->assertEquals('1.00', $this->object->apply(1));
    }

    public function testApplyWhenFloatIsGiven()
    {
        $this->assertEquals('1.50', $this->object->apply(1.5));
    }

    public function testApplyWhenThousandsIsGiven()
    {
        $this->assertEquals('1,000.50', $this->object->apply(1000.5));
    }

    public function testApplyWithDifferentDecimalPointAndThousandsSeparator()
    {
        $this->object->setDecimalPoint(FloatFormat::SEPARATOR_COMMA);
        $this->object->setThousandsSeparator(FloatFormat::SEPARATOR_DOT);
        $this->assertEquals('1.000,50', $this->object->apply(1000.5));
    }

    public function testApplyWhenDoubleIsGiven()
    {
        $this->assertEquals('1.80', $this->object->apply(1.8));
    }

    public function testApplyWhenDefinedLength()
    {
        $this->object->setLength(5);
        $this->assertTrue('01.00' === $this->object->apply(1));
    }

    public function testApplyWhenDefinedLengthAndFillRight()
    {
        $this->object
            ->setLength(5)
            ->setFillOn(FloatFormat::FILL_ON_RIGHT);
        $this->assertTrue('1.000' === $this->object->apply(1));
    }

    /**
     * @expectedException \PositionalData\Format\Exception\ConvertionException
     */
    public function testErrorWhenAStringIsGiven()
    {
        $this->object->apply('text');
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