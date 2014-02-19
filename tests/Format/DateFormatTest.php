<?php

namespace EletronicData\Tests\Format;

use EletronicData\Format\DateFormat;

class DateFormatTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var DateFormat
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new DateFormat();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetAndGetFormat()
    {
        $this->object->setFormat(DateFormat::FORMAT_DDMMYYYY);
        $this->assertEquals('dmY', $this->object->getFormat());

        $this->object->setFormat(DateFormat::FORMAT_MMDDYYYY);
        $this->assertEquals('mdY', $this->object->getFormat());

        $this->object->setFormat(DateFormat::FORMAT_YYYYMMDD);
        $this->assertEquals('Ymd', $this->object->getFormat());

        $this->object->setFormat(DateFormat::FORMAT_YYYYMM);
        $this->assertEquals('Ym', $this->object->getFormat());

        $this->object->setFormat('Y-m-d');
    }

    public function testApplyDefaultFormat()
    {
        $date = new \DateTime('2014-02-01');
        $this->assertEquals('20140201', $this->object->apply($date));
    }

    public function testApplyYearMonthDayFormat()
    {
        $date = new \DateTime('2014-02-01');
        $this->object->setFormat(DateFormat::FORMAT_YYYYMMDD);
        $this->assertEquals('20140201', $this->object->apply($date));
    }

    public function testApplyDayMonthYearFormat()
    {
        $date = new \DateTime('2014-02-01');
        $this->object->setFormat(DateFormat::FORMAT_DDMMYYYY);
        $this->assertEquals('01022014', $this->object->apply($date));
    }

    public function testApplyMonthDayYearFormat()
    {
        $date = new \DateTime('2014-02-01');
        $this->object->setFormat(DateFormat::FORMAT_MMDDYYYY);
        $this->assertEquals('02012014', $this->object->apply($date));
    }

    public function testApplyFormatFromString()
    {
        $date = '2014-02-01';
        $this->assertEquals('20140201', $this->object->apply($date));
    }

    /**
     * @expectedException \EletronicData\Format\Exception\ConvertionException
     */
    public function testErrorOnApplyApplyFormat()
    {
        $date = '01-02-2014';
        $this->object->apply($date);
    }

    public function testApplyFormatFromFullDateString()
    {
        $date = '2014-02-01 00:00:00';
        $this->assertEquals('20140201', $this->object->apply($date));
    }

    public function testApplyFormatFromIso8601()
    {
        $date = '2014-02-01T00:00:00';
        $this->assertEquals('20140201', $this->object->apply($date));
    }

    public function testApplyYearMonthFormat()
    {
        $date = '2014-02-01T00:00:00';
        $this->object->setFormat(DateFormat::FORMAT_YYYYMM);
        $this->assertEquals('201402', $this->object->apply($date));
    }
}