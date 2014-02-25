<?php

namespace PositionalData\Document;

use Doctrine\Common\Collections\ArrayCollection;
use PositionalData\Field\Field;
use PositionalData\Segment\Segment;
use PositionalData\Type\IntegerType;

class DocumentTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Document
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new Document();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testSetAndGetEndOfLine()
    {
        $this->object->setEndOfLine('|');
        $this->assertEquals('|', $this->object->getEndOfLine());
    }

    public function testSetGetAndAddSegments()
    {
        $segment = new Segment();
        $segments = new ArrayCollection(array($segment));
        $this->object->setSegments($segments);
        $this->object->addSegment(new Segment());
        $this->assertCount(2, $this->object->getSegments());
    }

    public function testToString()
    {
        $segment = new Segment();
        $segment->addField(new Field(array('length' => 2, 'type' => new IntegerType(), 'value' => 1)));
        $segment->addField(new Field(array('length' => 3, 'type' => new IntegerType(), 'value' => 10)));
        $segments = new ArrayCollection(array($segment));
        $this->object->setSegments($segments);
        $this->assertCount(1, $this->object->getSegments());
        $this->assertEquals('01010', $this->object->toString());
        $this->assertEquals('01;010', $this->object->toString(';'));
    }
}
