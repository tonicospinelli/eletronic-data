<?php

namespace EletronicData\Type;

use EletronicData\Format\FormatInterface;

abstract class AbstractType implements TypeInterface
{

    /**
     * @var int
     */
    protected $length;

    /**
     * @var FormatInterface
     */
    protected $format;

    /**
     * @inheritdoc
     */
    public function setLength($length)
    {
        $this->length = (int)$length;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @inheritdoc
     */
    abstract public function getName();

    /**
     * @return TypeInterface
     */
    public static function create()
    {
        $type = new static();
        $format = get_class($type);
        die($format);
    }

    /**
     * @inheritdoc
     */
    public function setFormat(FormatInterface $format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFormat()
    {
        if ($this->format instanceof FormatInterface) {
            $this->format->setLength($this->getLength());
        }

        return $this->format;
    }
}