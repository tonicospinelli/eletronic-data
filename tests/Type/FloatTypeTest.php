<?php

namespace PositionalFile\Tests\Type;

use PositionalFile\Type\FloatType;

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

        $this->assertInstanceOf('PositionalFile\Type\TypeInterface', $type);
        $this->assertInstanceOf('PositionalFile\Type\FloatType', $type);
        $this->assertInstanceOf('PositionalFile\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('PositionalFile\Format\FloatFormat', $type->getFormat());
    }
}