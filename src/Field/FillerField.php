<?php

namespace PositionalFile\Field;

use PositionalFile\Type\StringType;

class FillerField extends AbstractField
{

    public function __construct(array $data = array())
    {
        $default = array(
            'length'      => 1,
            'value'       => ' ',
            'name'        => 'filler',
            'description' => 'Fill with blank',
            'type'        => new StringType(),
        );
        $data = array_merge($default, $data);
        parent::__construct($data);
    }

    /**
     * @inheritdoc
     */
    public function getFormattedValue()
    {
        return str_repeat($this->getValue(), $this->getLength());
    }
}
