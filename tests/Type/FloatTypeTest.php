<?php

namespace EletronicData\Tests\Type;

use EletronicData\Type\FloatType;

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

        $this->assertInstanceOf('EletronicData\Type\TypeInterface', $type);
        $this->assertInstanceOf('EletronicData\Type\FloatType', $type);
        $this->assertInstanceOf('EletronicData\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('EletronicData\Format\FloatFormat', $type->getFormat());
    }
}