<?php

namespace PositionalFile\Format;

interface FormatInterface
{

    const FILL_ON_BOTH = STR_PAD_BOTH;

    const FILL_ON_LEFT = STR_PAD_LEFT;

    const FILL_ON_RIGHT = STR_PAD_RIGHT;

    /**
     * Sets string to fill the value.
     *
     * @param string $string
     *
     * @return FormatInterface
     */
    public function setFillWith($string);

    /**
     * Sets string to fill the value.
     * @return string
     */
    public function getFillWith();

    /**
     * Sets fill before, after or both the value.
     *
     * @param int $fillOn can be FormatInterface::FILL_ON_BOTH, FormatInterface::FILL_ON_LEFT,
     *                    or FormatInterface::FILL_ON_RIGHT. If it is not specified it is assumed
     *                    to be FormatInterface::FILL_ON_RIGHT.
     *
     * @return FormatInterface
     */
    public function setFillOn($fillOn);

    /**
     * Gets fill before, after or both the value.
     * @return int
     */
    public function getFillOn();

    /**
     * Sets max length of value will be formatted.
     *
     * @param int $length
     *
     * @return FormatInterface
     */
    public function setLength($length);

    /**
     * Gets max length of value will be formatted.
     * @return int
     */
    public function getLength();

    /**
     * Converts value to fill with some char.
     *
     * @param string $value
     *
     * @return string
     */
    public function convert($value);

    /**
     * Apply format to field based on its type.
     *
     * @param mixed $value
     *
     * @return string
     */
    public function apply($value);
}
