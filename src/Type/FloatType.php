<?php

namespace EletronicData\Type;

use EletronicData\Type\Exception\ConvertionException;
use EletronicData\Type\Exception\TypeException;

class FloatType extends IntegerType
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'float';
    }
}