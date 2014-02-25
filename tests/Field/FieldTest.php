<?php

namespace PositionalData\Tests\Field;

use PositionalData\Field\AbstractField;
use PositionalData\Field\Field;
use PositionalData\Type\AbstractType;

class FieldTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var AbstractField
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new Field();
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
        $type = $this->getMock('PositionalData\Type\TypeInterface');
        $this->object->setType($type);
        $this->assertInstanceOf('PositionalData\Type\TypeInterface', $this->object->getType());
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

    public function testSetFromArrayAndDiscardNonExistingMethod()
    {
        $this->object->setFromArray(array('value' => 'asd', 'nonExisting' => false));
        $this->assertEquals('asd', $this->object->getDefaultValue());
    }

    public function testGetFormattedNotBlankValue()
    {
        $format = $this->getMockForAbstractClass('PositionalData\Format\AbstractFormat');

        $format
            ->expects($this->once())
            ->method('convert')
            ->with($this->stringContains('asd'))
            ->will($this->returnValue('ASD'));

        /** @var AbstractType $type */
        $type = $this->getMockForAbstractClass('PositionalData\Type\AbstractType');
        $type->setFormat($format);

        $this->object->setLength(3);
        $this->object->setType($type);
        $this->object->setValue('asd');
        $this->assertEquals('ASD', $this->object->getFormattedValue());
    }

    public function testGetFormattedBlankValue()
    {
        $format = $this->getMockForAbstractClass('PositionalData\Format\AbstractFormat');

        $format
            ->expects($this->any())
            ->method('convert')
            ->with($this->stringContains(' '))
            ->will($this->returnValue(' '));

        /** @var AbstractType $type */
        $type = $this->getMockForAbstractClass('PositionalData\Type\AbstractType');
        $type->setFormat($format);

        $this->object->setType($type);
        $this->object->setLength(3);
        $this->object->setValue(' ');
        $this->assertEquals('   ', $this->object->getFormattedValue());
    }

    public function testGetFormattedBlankValueWithoutLength()
    {
        $format = $this->getMockForAbstractClass('PositionalData\Format\AbstractFormat');

        $format
            ->expects($this->any())
            ->method('convert')
            ->with($this->stringContains('0'))
            ->will($this->returnValue('0'));

        /** @var AbstractType $type */
        $type = $this->getMockForAbstractClass('PositionalData\Type\AbstractType');
        $type->setFormat($format);

        $this->object->setType($type);
        $this->object->setValue('0');
        $this->assertEquals('0', $this->object->getFormattedValue());
    }

    public function testSetFromArrayAndGetFormattedBlankValueWithoutLength()
    {
        $format = $this->getMockForAbstractClass('PositionalData\Format\AbstractFormat');

        $format
            ->expects($this->any())
            ->method('convert')
            ->with($this->stringContains('0'))
            ->will($this->returnValue('0'));

        /** @var AbstractType $type */
        $type = $this->getMockForAbstractClass('PositionalData\Type\AbstractType');
        $type->setFormat($format);

        $this->object->setFromArray(array(
            'type'  => $type,
            'value' => '0',
        ));
        $this->object->setValue('0');
        $this->assertEquals('0', $this->object->getFormattedValue());
    }

    public function testToArray()
    {
        $format = $this->getMockForAbstractClass('PositionalData\Format\AbstractFormat');

        $format
            ->expects($this->any())
            ->method('convert')
            ->with($this->stringContains('0'))
            ->will($this->returnValue('0'));

        /** @var AbstractType $type */
        $type = $this->getMockForAbstractClass('PositionalData\Type\AbstractType');
        $type->setFormat($format);

        $field = new Field(array('type' => $type, 'value' => '0'));

        $this->assertTrue(is_array($field->toArray()));
        $this->assertEquals(array('type' => $type, 'value' => '0'), $field->toArray());
    }
}