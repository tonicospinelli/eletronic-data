<?php

namespace EletronicData\Tests\Field;

use EletronicData\Field\AbstractField;

class FieldTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var AbstractField
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = $this->getMockForAbstractClass('EletronicData\Field\AbstractField');
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testSetAndGetDescription()
    {
        $this->object->setDescription('Description');
        $this->assertEquals('Description', $this->object->getDescription());
    }

    public function testSetAndGetFormat()
    {
        $format = $this->getMock('EletronicData\Format\FormatInterface');
        $this->object->setFormat($format);
        $this->assertInstanceOf('EletronicData\Format\FormatInterface', $this->object->getFormat());
    }

    public function testSetAndGetLength()
    {
        $this->object->setLength(10);
        $this->assertEquals(10, $this->object->getLength());
    }

    public function testSetAndGetName()
    {
        $this->object->setName('name');
        $this->assertEquals('name', $this->object->getName());
    }

    public function testSetAndGetSequential()
    {
        $this->object->setSequential(1);
        $this->assertEquals(1, $this->object->getSequential());
    }

    public function testSetAndGetStartPosition()
    {
        $this->object->setStartPosition(1);
        $this->assertEquals(1, $this->object->getStartPosition());
    }

    public function testSetAndGetEndPosition()
    {
        $this->object->setStartPosition(1);
        $this->object->setLength(1);
        $this->assertEquals(2, $this->object->getEndPosition());
    }

    public function testSetAndGetType()
    {
        $type = $this->getMock('EletronicData\Type\TypeInterface');
        $this->object->setType($type);
        $this->assertInstanceOf('EletronicData\Type\TypeInterface', $this->object->getType());
    }

    public function testSetAndGetValue()
    {
        $this->object->setValue('asd');
        $this->assertEquals('asd', $this->object->getValue());
    }

    public function testSetAndGetDefaultValue()
    {
        $this->object->setDefaultValue('asd');
        $this->assertEquals('asd', $this->object->getDefaultValue());
    }

    public function testGetFormattedNotBlankValue()
    {
        $format = $this->getMockForAbstractClass('EletronicData\Format\AbstractFormat');

        $format
            ->expects($this->once())
            ->method('convert')
            ->with($this->stringContains('asd'))
            ->will($this->returnValue('ASD'));

        $this->object->setLength(3);
        $this->object->setFormat($format);
        $this->object->setValue('asd');
        $this->assertEquals('ASD', $this->object->getFormattedValue());
    }

    public function testGetFormattedBlankValue()
    {
        $format = $this->getMockForAbstractClass('EletronicData\Format\AbstractFormat');

        $format
            ->expects($this->any())
            ->method('convert')
            ->with($this->stringContains(' '))
            ->will($this->returnValue(' '));
        $this->object->setLength(3);
        $this->object->setFormat($format);
        $this->object->setValue(' ');
        $this->assertEquals('   ', $this->object->getFormattedValue());
    }
}