<?php

namespace PositionalData\Type;

use PositionalData\Format\FormatInterface;
use PositionalData\Format\IntegerFormat;

class IntegerType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function getFormat()
    {
        if (!$this->format instanceof FormatInterface) {
            $this->format = new IntegerFormat();
        }

        return parent::getFormat();
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'integer';
    }
}
