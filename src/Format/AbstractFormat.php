<?php

namespace PositionalFile\Format;

use PositionalFile\Format\Exception\FormatException;

abstract class AbstractFormat implements FormatInterface
{

    protected $length;

    protected $fillWith = ' ';

    protected $fillOn = self::FILL_ON_RIGHT;

    /**
     * @inheritdoc
     */
    public function setFillOn($fillOn)
    {
        switch ($fillOn) {
            case self::FILL_ON_BOTH:
            case self::FILL_ON_RIGHT:
            case self::FILL_ON_LEFT:
                $this->fillOn = $fillOn;
                break;
            default:
                throw new FormatException('The argument ' . $fillOn . ' is not allowed fill type');
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFillOn()
    {
        return $this->fillOn;
    }

    /**
     * @inheritdoc
     */
    public function setFillWith($fillWith)
    {
        $this->fillWith = (string)$fillWith;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFillWith()
    {
        return $this->fillWith;
    }

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
    abstract public function convert($value);

    /**
     * @inheritdoc
     */
    public function apply($value)
    {
        if (is_string($value) and $value == ' ') {
            return str_repeat($value, $this->getLength());
        }

        return str_pad($this->convert($value), $this->getLength(), $this->getFillWith(), $this->getFillOn());
    }
}
