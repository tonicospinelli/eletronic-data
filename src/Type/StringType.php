<?php

namespace PositionalFile\Type;

use PositionalFile\Format\FormatInterface;
use PositionalFile\Format\StringFormat;

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
