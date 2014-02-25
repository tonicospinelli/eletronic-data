<?php

namespace PositionalData\Type;

use PositionalData\Format\DateFormat;
use PositionalData\Format\FormatInterface;

class DateType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function getFormat()
    {
        if (!$this->format instanceof FormatInterface) {
            $this->format = new DateFormat();
        }

        return parent::getFormat();
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'date';
    }
}
