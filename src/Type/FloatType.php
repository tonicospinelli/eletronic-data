<?php

namespace EletronicData\Type;

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