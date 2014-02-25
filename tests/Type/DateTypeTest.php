<?php

namespace PositionalData\Tests\Type;

use PositionalData\Type\DateType;

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

        $this->assertInstanceOf('PositionalData\Type\TypeInterface', $type);
        $this->assertInstanceOf('PositionalData\Type\DateType', $type);
        $this->assertInstanceOf('PositionalData\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('PositionalData\Format\DateFormat', $type->getFormat());
    }
}