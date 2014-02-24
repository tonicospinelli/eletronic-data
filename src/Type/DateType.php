<?php

namespace EletronicData\Type;

use EletronicData\Type\Exception\ConvertionException;

class DateType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'date';
    }
}