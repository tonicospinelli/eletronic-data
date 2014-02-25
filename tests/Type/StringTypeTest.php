<?php

namespace PositionalFile\Tests\Type;

use PositionalFile\Type\StringType;

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

        $this->assertInstanceOf('PositionalFile\Type\TypeInterface', $type);
        $this->assertInstanceOf('PositionalFile\Type\StringType', $type);
        $this->assertInstanceOf('PositionalFile\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('PositionalFile\Format\StringFormat', $type->getFormat());
    }
}