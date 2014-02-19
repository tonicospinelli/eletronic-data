<?php

namespace EletronicData\Format;

use EletronicData\Format\Exception\ConvertionException;

class StringFormat extends AbstractFormat
{

    public function __construct()
    {
        $this
            ->setFillOn(FormatInterface::FILL_ON_RIGHT)
            ->setFillWith(' ');
    }

    /**
     * @inheritdoc
     */
    public function convert($value)
    {
        if(!is_string($value) and !is_numeric($value)){
            throw new ConvertionException('The value given cannot be converted to Integer.');
        }

        return (string)$value;
    }
}