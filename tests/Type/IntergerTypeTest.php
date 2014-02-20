<?php

namespace EletronicData\Tests\Type;

use EletronicData\Type\IntegerType;

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

        $this->assertInstanceOf('EletronicData\Type\TypeInterface', $type);
        $this->assertInstanceOf('EletronicData\Type\IntegerType', $type);
        $this->assertInstanceOf('EletronicData\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('EletronicData\Format\IntegerFormat', $type->getFormat());
    }
}