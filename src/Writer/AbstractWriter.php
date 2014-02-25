<?php

namespace PositionalData\Writer;

use PositionalData\Document\DocumentInterface;

abstract class AbstractWriter implements WriterInterface
{

    /**
     * @var DocumentInterface
     */
    protected $document;

    /**
     * @var string
     */
    protected $separator;

    /**
     * @inheritdoc
     */
    public function setDocument(DocumentInterface $document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param string $separator
     *
     * @return AbstractWriter
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * @inheritdoc
     */
    public function write()
    {
        return $this->getDocument()->toString($this->getSeparator());
    }

    /**
     * @param string $fileName
     *
     * @return bool
     */
    public function writeFile($fileName)
    {
        $content = $this->write();
        $file = new \SplFileObject($fileName, 'w');
        $file->fwrite($content);
    }
}
