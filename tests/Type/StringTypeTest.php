<?php

namespace EletronicData\Tests\Type;

use EletronicData\Type\StringType;

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

        $this->assertInstanceOf('EletronicData\Type\TypeInterface', $type);
        $this->assertInstanceOf('EletronicData\Type\StringType', $type);
        $this->assertInstanceOf('EletronicData\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('EletronicData\Format\StringFormat', $type->getFormat());
    }
}