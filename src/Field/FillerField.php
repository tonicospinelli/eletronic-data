<?php

namespace EletronicData\Field;

class FillerField extends AbstractField
{

    public function __construct($startPosition = null, $length = null)
    {
        $this
            ->setDefaultValue('0')
            ->setName('filler')
            ->setDescription('Fill with blank')
            ->setStartPosition($startPosition)
            ->setLength($length);
    }

    /**
     * @inheritdoc
     */
    public function getFormattedValue()
    {
        return str_repeat($this->getValue(), $this->getLength());
    }
}