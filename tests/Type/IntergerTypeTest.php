<?php

namespace PositionalData\Tests\Type;

use PositionalData\Type\IntegerType;

class IntegerTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var IntegerType
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new IntegerType();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testGetName()
    {
        $this->assertEquals('integer', $this->object->getName());
    }

    public function testCreate()
    {
        $type = IntegerType::create();

        $this->assertInstanceOf('PositionalData\Type\TypeInterface', $type);
        $this->assertInstanceOf('PositionalData\Type\IntegerType', $type);
        $this->assertInstanceOf('PositionalData\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('PositionalData\Format\IntegerFormat', $type->getFormat());
    }
}