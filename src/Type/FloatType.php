<?php

namespace PositionalData\Type;

use PositionalData\Format\FloatFormat;
use PositionalData\Format\FormatInterface;

class FloatType extends IntegerType
{
    /**
     * @inheritdoc
     */
    public function getFormat()
    {
        if (!$this->format instanceof FormatInterface) {
            $this->format = new FloatFormat();
        }

        return parent::getFormat();
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'float';
    }
}
