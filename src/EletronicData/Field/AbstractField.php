<?php

namespace EletronicData\Field;

use EletronicData\Format\FormatInterface;
use EletronicData\Type\TypeInterface;

abstract class AbstractField implements FieldInterface
{

    /**
     * @var int
     */
    protected $sequential;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $startPosition;

    /**
     * @var int
     */
    protected $length;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var TypeInterface
     */
    protected $type;

    /**
     * @var FormatInterface
     */
    protected $format;

    /**
     * @inheritdoc
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function setFormat(FormatInterface $format)
    {
        $format->setLength($this->getLength());
        $this->format = $format;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @inheritdoc
     */
    public function setLength($length)
    {
        $this->length = $length;

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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setSequential($sequential)
    {
        $this->sequential = $sequential;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSequential()
    {
        return $this->sequential;
    }

    /**
     * @inheritdoc
     */
    public function getEndPosition()
    {
        return $this->startPosition + $this->length;
    }

    /**
     * @inheritdoc
     */
    public function setStartPosition($startPosition)
    {
        $this->startPosition = $startPosition;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getStartPosition()
    {
        return $this->startPosition;
    }

    /**
     * @inheritdoc
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function setDefaultValue($value)
    {
        $this->setValue($value);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDefaultValue()
    {
        return $this->getValue();
    }

    /**
     * @inheritdoc
     */
    public function getFormattedValue()
    {
        $value = $this->getFormat()->apply($this->getValue());
        if ($this->getLength() > 0) {
            return mb_substr($value, 0, $this->getLength());
        }

        return $value;
    }
}