<?php

namespace PositionalFile\Type;

use PositionalFile\Format\FloatFormat;
use PositionalFile\Format\FormatInterface;

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
