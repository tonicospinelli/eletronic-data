<?php

namespace PositionalFile\Tests\Field;

use PositionalFile\Field\FillerField;

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

    public function testCreateAFillerFieldWithZeroAndGetFormattedValue()
    {
        $filler = new FillerField(array('startPosition' => 1, 'length' => 5, 'value' => 0));
        $this->assertEquals('0', $filler->getDefaultValue());
        $this->assertEquals('filler', $filler->getName());
        $this->assertEquals(1, $filler->getStartPosition());
        $this->assertEquals(5, $filler->getLength());
        $this->assertEquals(6, $filler->getEndPosition());

        $this->assertEquals('00000', $filler->getFormattedValue());
    }

    public function testCreateAFillerFieldWithBlankAndGetFormattedValue()
    {
        $filler = new FillerField(array('startPosition' => 1, 'length' => 5));
        $this->assertEquals(' ', $filler->getDefaultValue());
        $this->assertEquals('filler', $filler->getName());
        $this->assertEquals(1, $filler->getStartPosition());
        $this->assertEquals(5, $filler->getLength());
        $this->assertEquals(6, $filler->getEndPosition());

        $this->assertEquals('     ', $filler->getFormattedValue());
    }
}