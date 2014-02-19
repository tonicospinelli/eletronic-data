<?php

namespace EletronicData\Field;

use EletronicData\Format\FormatInterface;
use EletronicData\Type\TypeInterface;

class FillerField extends AbstractField
{

    public function __construct($startPosition = null, $length = null)
    {
        $this
            ->setDefaultValue(' ')
            ->setName('filler')
            ->setDescription('Fill with blank')
            ->setStartPosition($startPosition)
            ->setLength($length);
    }
}