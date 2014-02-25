<?php

namespace PositionalFile\Tests\Type;

use PositionalFile\Type\DateType;

class DateTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var DateType
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new DateType();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testGetName()
    {
        $this->assertEquals('date', $this->object->getName());
    }

    public function testCreate()
    {
        $type = DateType::create();

        $this->assertInstanceOf('PositionalFile\Type\TypeInterface', $type);
        $this->assertInstanceOf('PositionalFile\Type\DateType', $type);
        $this->assertInstanceOf('PositionalFile\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('PositionalFile\Format\DateFormat', $type->getFormat());
    }
}