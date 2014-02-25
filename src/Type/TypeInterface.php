<?php

namespace PositionalData\Type;

use PositionalData\Format\FormatInterface;

interface TypeInterface
{

    /**
     * Gets type name.
     * @return string
     */
    public function getName();

    /**
     * @return TypeInterface
     */
    public static function create();

    /**
     * Sets max length of value will be formatted.
     *
     * @param int $length
     *
     * @return TypeInterface
     */
    public function setLength($length);

    /**
     * Gets max length of value will be formatted.
     * @return int
     */
    public function getLength();

    /**
     * Sets type's format
     * @param FormatInterface $format
     *
     * @return TypeInterface
     */
    public function setFormat(FormatInterface $format);

    /**
     * Gets type's format
     * @return FormatInterface
     */
    public function getFormat();
}