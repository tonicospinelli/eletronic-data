<?php

namespace PositionalFile\Tests\Segment;

use Doctrine\Common\Collections\ArrayCollection;
use PositionalFile\Field\Field;
use PositionalFile\Field\FieldInterface;
use PositionalFile\Segment\AbstractSegment;
use PositionalFile\Segment\Segment;
use PositionalFile\Type\IntegerType;
use PositionalFile\Type\StringType;

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
        $field = $this->getMock('PositionalFile\Field\AbstractField');
        $this->object->addField($field);
        $this->assertCount(1, $this->object->getFields());
    }

    public function testSetAndCountField()
    {
        $field = $this->getMock('PositionalFile\Field\AbstractField');
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
        $expected = '01|TEST ';
        $this->assertEquals($expected, $this->object->toString('|'));
    }
}