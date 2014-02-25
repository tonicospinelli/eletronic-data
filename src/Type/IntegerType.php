<?php

namespace PositionalFile\Type;

use PositionalFile\Format\FormatInterface;
use PositionalFile\Format\IntegerFormat;

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
