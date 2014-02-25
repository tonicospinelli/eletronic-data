<?php

namespace PositionalFile\Tests\Type;

use PositionalFile\Type\IntegerType;

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

        $this->assertInstanceOf('PositionalFile\Type\TypeInterface', $type);
        $this->assertInstanceOf('PositionalFile\Type\IntegerType', $type);
        $this->assertInstanceOf('PositionalFile\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('PositionalFile\Format\IntegerFormat', $type->getFormat());
    }
}