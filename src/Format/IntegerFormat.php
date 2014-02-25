<?php

namespace PositionalFile\Format;

use PositionalFile\Format\Exception\ConvertionException;

class IntegerFormat extends AbstractFormat
{

    public function __construct()
    {
        $this
            ->setFillOn(FormatInterface::FILL_ON_LEFT)
            ->setFillWith('0');
    }

    /**
     * @inheritdoc
     */
    public function convert($value)
    {
        if (!is_numeric($value)) {
            throw new ConvertionException('The value given cannot be converted to Integer.');
        }

        return (int)$value;
    }
}
