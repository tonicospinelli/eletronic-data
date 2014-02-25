<?php

namespace PositionalData\Tests\Type;

use PositionalData\Type\StringType;

class StringTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var StringType
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new StringType();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    public function testGetName()
    {
        $this->assertEquals('string', $this->object->getName());
    }

    public function testCreate()
    {
        $type = StringType::create();

        $this->assertInstanceOf('PositionalData\Type\TypeInterface', $type);
        $this->assertInstanceOf('PositionalData\Type\StringType', $type);
        $this->assertInstanceOf('PositionalData\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('PositionalData\Format\StringFormat', $type->getFormat());
    }
}