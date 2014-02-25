<?php

namespace PositionalData\Type;

use PositionalData\Format\FormatInterface;
use PositionalData\Format\StringFormat;

class StringType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function getFormat()
    {
        if (!$this->format instanceof FormatInterface) {
            $this->format = new StringFormat();
        }

        return parent::getFormat();
    }


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'string';
    }
}
