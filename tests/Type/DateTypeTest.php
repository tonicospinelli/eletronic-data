<?php

namespace EletronicData\Tests\Type;

use EletronicData\Type\DateType;

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

        $this->assertInstanceOf('EletronicData\Type\TypeInterface', $type);
        $this->assertInstanceOf('EletronicData\Type\DateType', $type);
        $this->assertInstanceOf('EletronicData\Format\FormatInterface', $type->getFormat());
        $this->assertInstanceOf('EletronicData\Format\DateFormat', $type->getFormat());
    }
}