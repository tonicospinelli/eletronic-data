<?php

namespace PositionalFile\Type;

use PositionalFile\Format\DateFormat;
use PositionalFile\Format\FormatInterface;

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
