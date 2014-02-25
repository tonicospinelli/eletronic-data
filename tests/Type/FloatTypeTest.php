<?php

namespace PositionalData\Tests\Type;

use PositionalData\Type\FloatType;

class FloatTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var FloatType
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new FloatType();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testGetName()
    {
        $this->assertEquals('float', $this->object->getName());
    }

    public function testCreate()
    {
        $type = FloatType::create();

        $this->assertInstanceOf('PositionalData\Type\TypeInterface', $type);
        $this->assertInstanceOf('PositionalData\Type\FloatType', $type);
        $this->assertInstanceOf('PositionalData\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('PositionalData\Format\FloatFormat', $type->getFormat());
    }
}