<?php

namespace PositionalData\Tests\Segment;

use Doctrine\Common\Collections\ArrayCollection;
use PositionalData\Segment\AbstractSegment;

class SegmentTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var AbstractSegment
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = $this->getMockForAbstractClass('PositionalData\Segment\AbstractSegment');
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

}