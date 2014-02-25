<?php

namespace PositionalData\Tests\Writer;

use PositionalData\Document\Document;
use PositionalData\Field\Field;
use PositionalData\Field\FieldInterface;
use PositionalData\Field\FillerField;
use PositionalData\Segment\Segment;
use PositionalData\Type\DateType;
use PositionalData\Type\IntegerType;
use PositionalData\Type\StringType;
use PositionalData\Writer\Writer;
use PositionalData\Writer\WriterInterface;

class WriterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Writer
     */
    protected $object;

    protected $fileName;

    protected function setUp()
    {
        parent::setUp();
        $this->fileName = __DIR__ . DIRECTORY_SEPARATOR . 'test.txt';
        $this->object = new Writer();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->object = null;
        if (file_exists($this->fileName)) {
            unlink($this->fileName);
        }
    }

    protected function getFieldLayout()
    {
        return array(
            array(
                array(
                    'sequential'    => 1,
                    'name'          => 'line_number',
                    'startPosition' => 1,
                    'length'        => 2,
                    'description'   => 'number of line',
                    'type'          => new IntegerType(),
                    'value'         => '1'
                ),
                array(
                    'sequential'    => 2,
                    'name'          => 'document_code',
                    'startPosition' => 3,
                    'length'        => 5,
                    'description'   => 'document code',
                    'type'          => new StringType(),
                    'value'         => 'TEST'
                ),
                array(
                    'sequential'    => 3,
                    'name'          => 'date',
                    'startPosition' => 3,
                    'length'        => 8,
                    'description'   => 'date',
                    'type'          => new DateType(),
                    'value'         => '2014-02-25'
                ),
                new FillerField(array('length' => 5)),
            ),
            array(
                array(
                    'sequential'    => 2,
                    'name'          => 'document_code',
                    'startPosition' => 3,
                    'length'        => 5,
                    'description'   => 'document code',
                    'type'          => new StringType(),
                    'value'         => 'TEST2'
                ),
                new FillerField(array('length' => 5)),
                array(
                    'sequential'    => 4,
                    'name'          => 'date',
                    'startPosition' => 3,
                    'length'        => 8,
                    'description'   => 'date',
                    'type'          => new DateType(),
                    'value'         => new \DateTime('2014-02-25')
                ),
                array(
                    'sequential'    => 1,
                    'name'          => 'line_number',
                    'startPosition' => 1,
                    'length'        => 2,
                    'description'   => 'number of line',
                    'type'          => new IntegerType(),
                    'value'         => '2'
                ),
            )
        );
    }

    protected function getDocument()
    {
        $document = new Document();
        $fields = $this->getFieldLayout();
        foreach ($fields as $segment) {
            $segment = $this->createSegment($segment);
            $document->addSegment($segment);
        }

        return $document;
    }

    /**
     * @param array $data
     *
     * @return Segment
     */
    protected function createSegment($data)
    {
        $segment = new Segment();
        foreach ($data as $field) {
            if (!$field instanceof FieldInterface) {
                $field = new Field($field);
            }
            $segment->addField($field);
        }

        return $segment;
    }

    public function testCreateDocument()
    {
        $document = $this->getDocument();

        $this->object->setDocument($document);

        $this->assertCount(2, $document->getSegments());

        $expected = '01TEST      20140225' . PHP_EOL . '02     TEST220140225';
        $this->assertEquals($expected, $this->object->write());
    }

    public function testCreateDocumentWithColonSeparator()
    {
        $document = $this->getDocument();

        $this->object->setDocument($document);
        $this->object->setSeparator(WriterInterface::SEPARATOR_COLON);

        $this->assertCount(2, $document->getSegments());

        $expected = '01:TEST::20140225' . PHP_EOL . '02::TEST2:20140225';
        $this->assertEquals($expected, $this->object->write());
    }

    public function testCreateDocumentWithSemicolonSeparator()
    {
        $document = $this->getDocument();

        $this->object->setDocument($document);
        $this->object->setSeparator(WriterInterface::SEPARATOR_SEMICOLON);

        $this->assertCount(2, $document->getSegments());

        $expected = '01;TEST;;20140225' . PHP_EOL . '02;;TEST2;20140225';
        $this->assertEquals($expected, $this->object->write());
    }

    public function testCreateDocumentWithSemicolonSeparatorAndWriteFile()
    {
        $document = $this->getDocument();

        $this->object->setDocument($document);
        $this->object->setSeparator(WriterInterface::SEPARATOR_SEMICOLON);

        $this->assertCount(2, $document->getSegments());

        $expected = '01;TEST;;20140225' . PHP_EOL . '02;;TEST2;20140225';

        $this->object->writeFile($this->fileName);

        $this->assertFileExists($this->fileName);
        $this->assertStringEqualsFile($this->fileName, $expected);
    }
}