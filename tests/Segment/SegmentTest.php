<?php

namespace EletronicData\Tests\Segment;

use Doctrine\Common\Collections\ArrayCollection;
use EletronicData\Segment\AbstractSegment;

class SegmentTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var AbstractSegment
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = $this->getMockForAbstractClass('EletronicData\Segment\AbstractSegment');
    }

    public function testAddAndCountField()
    {
        $field = $this->getMock('EletronicData\Field\AbstractField');
        $this->object->addField($field);
        $this->assertCount(1, $this->object->getFields());
    }

    public function testSetAndCountField()
    {
        $field = $this->getMock('EletronicData\Field\AbstractField');
        $this->object->setFields(new ArrayCollection(array($field)));
        $this->assertCount(1, $this->object->getFields());
    }

}