<?php

namespace PositionalData\Writer;

use PositionalData\Document\DocumentInterface;

interface WriterInterface
{

    const SEPARATOR_COMMA = ',';

    const SEPARATOR_DOT = '.';

    const SEPARATOR_COLON = ':';

    const SEPARATOR_SEMICOLON = ';';

    const SEPARATOR_PIPE = '|';

    /**
     * @param DocumentInterface $document
     *
     * @return WriterInterface
     */
    public function setDocument(DocumentInterface $document);

    /**
     * @return DocumentInterface
     */
    public function getDocument();

    /**
     * @param string $separator
     *
     * @return AbstractWriter
     */
    public function setSeparator($separator);

    /**
     * @return string
     */
    public function getSeparator();

    /**
     * @return string
     */
    public function write();

    /**
     * @param string $fileName
     *
     * @return bool
     */
    public function writeFile($fileName);
}
