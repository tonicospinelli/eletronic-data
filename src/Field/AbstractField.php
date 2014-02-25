<?php

namespace PositionalFile\Field;

use PositionalFile\Type\TypeInterface;

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

    public function __construct(array $data = array())
    {
        $this->setFromArray($data);
    }

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
        $type->setLength($this->getLength());
        $this->type = $type;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        $this->type->setLength($this->getLength());

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
        $value = $this->getType()->getFormat()->apply($this->getValue());

        if ($this->getLength() > 0) {
            return mb_substr($value, 0, $this->getLength());
        }

        return $value;
    }

    /**
     * Sets existing data from array.
     *
     * @param array $data
     *
     * @return FieldInterface
     */
    public function setFromArray(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (!method_exists($this, $method)) {
                continue;
            }
            $this->$method($value);
        }

        return $this;
    }

    /**
     * Converts the field to array.
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this as $property => $value) {
            if (is_null($value)) {
                continue;
            }
            $array[$property] = $value;
        }

        return $array;
    }
}
