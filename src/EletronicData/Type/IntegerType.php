<?php

namespace EletronicData\Type;

use EletronicData\Type\Exception\ConvertionException;

class IntegerType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'integer';
    }
}