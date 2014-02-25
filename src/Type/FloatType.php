<?php

namespace PositionalData\Type;

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