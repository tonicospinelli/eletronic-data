<?php

namespace PositionalData\Tests\Segment;

use Doctrine\Common\Collections\ArrayCollection;
use PositionalData\Field\Field;
use PositionalData\Field\FieldInterface;
use PositionalData\Segment\AbstractSegment;
use PositionalData\Segment\Segment;
use PositionalData\Type\IntegerType;
use PositionalData\Type\StringType;

class SegmentTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var AbstractSegment
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new Segment();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testAddAndCountField()
    {
        $field = $this->getMock('PositionalData\Field\AbstractField');
        $this->object->addField($field);
        $this->assertCount(1, $this->object->getFields());
    }

    public function testSetAndCountField()
    {
        $field = $this->getMock('PositionalData\Field\AbstractField');
        $this->object->setFields(new ArrayCollection(array($field)));
        $this->assertCount(1, $this->object->getFields());
    }

    public function testToString()
    {
        $this->object->addField(
            new Field(array(
                'length' => 2,
                'type'   => new IntegerType(),
                'value'  => 1
            ))
        );
        $this->object->addField(
            new Field(array(
                'length' => 5,
                'type'   => new StringType(),
                'value'  => 'TEST'
            ))
        );
        $expected = '01TEST ';
        $this->assertEquals($expected, $this->object->toString());
    }

    public function testToStringWithPipeSeparator()
    {
        $this->object->addField(
            new Field(array(
                'length' => 2,
                'type'   => new IntegerType(),
                'value'  => 1
            ))
        );
        $this->object->addField(
            new Field(array(
                'length' => 5,
                'type'   => new StringType(),
                'value'  => 'TEST'
            ))
        );
        $expected = '01|TEST';
        $this->assertEquals($expected, $this->object->toString('|'));
    }
}