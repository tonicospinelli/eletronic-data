<?php

namespace EletronicData\Tests\Field;

use EletronicData\Field\FillerField;

class FillerFieldTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var FillerField
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new FillerField();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testCreateAFillerField()
    {
        $filler = new FillerField(1, 5);
        $this->assertEquals('0', $filler->getDefaultValue());
        $this->assertEquals('filler', $filler->getName());
        $this->assertEquals(1, $filler->getStartPosition());
        $this->assertEquals(5, $filler->getLength());
        $this->assertEquals(6, $filler->getEndPosition());

        $this->assertEquals('00000', $filler->getFormattedValue());
    }
}