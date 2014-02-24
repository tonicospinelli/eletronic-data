<?php

namespace EletronicData\Format;

use EletronicData\Format\Exception\ConvertionException;

class FloatFormat extends IntegerFormat
{

    const SEPARATOR_DOT = '.';

    const SEPARATOR_COMMA = ',';

    /**
     * @var int
     */
    protected $decimalLength;

    /**
     * @var string
     */
    protected $decimalPoint = '.';

    /**
     * @var string
     */
    protected $thousandsSeparator;

    public function __construct()
    {
        parent::__construct();
        $this->setDecimalLength(2)
            ->setDecimalPoint(self::SEPARATOR_DOT)
            ->setThousandsSeparator(self::SEPARATOR_COMMA);
    }


    /**
     * Sets the decimal length.
     *
     * @param int $decimalLength
     *
     * @return FloatFormat
     */
    public function setDecimalLength($decimalLength)
    {
        $this->decimalLength = (int)$decimalLength;

        return $this;
    }

    /**
     * Gets the decimal length.
     * @return int
     */
    public function getDecimalLength()
    {
        return $this->decimalLength;
    }

    /**
     * Sets the decimal point.
     *
     * @param string $decimalPoint
     *
     * @throws \InvalidArgumentException
     * @return FloatFormat
     */
    public function setDecimalPoint($decimalPoint)
    {
        switch ($decimalPoint) {
            case self::SEPARATOR_COMMA:
            case self::SEPARATOR_DOT:
                $this->decimalPoint = $decimalPoint;
                break;
            default:
                throw new \InvalidArgumentException(
                    'The given thousand separator ' . $decimalPoint . ' is not recognized'
                );
        }


        return $this;
    }

    /**
     * Sets the decimal point.
     * @return string
     */
    public function getDecimalPoint()
    {
        return $this->decimalPoint;
    }

    /**
     * Sets the thousands separator.
     *
     * @param string $thousandsSeparator
     *
     * @throws \InvalidArgumentException
     * @return FloatFormat
     */
    public function setThousandsSeparator($thousandsSeparator)
    {
        switch ($thousandsSeparator) {
            case self::SEPARATOR_COMMA:
            case self::SEPARATOR_DOT:
                $this->thousandsSeparator = $thousandsSeparator;
                break;
            default:
                throw new \InvalidArgumentException(
                    'The given thousand separator ' . $thousandsSeparator . ' is not recognized'
                );
        }

        return $this;
    }

    /**
     * Gets the thousands separator.
     * @return string
     */
    public function getThousandsSeparator()
    {
        return $this->thousandsSeparator;
    }

    /**
     * @inheritdoc
     */
    public function convert($value)
    {
        if (!is_numeric($value)) {
            throw new ConvertionException('The value given cannot be converted to Float.');
        }

        $length = $this->getDecimalLength();
        $separator = $this->getThousandsSeparator();
        $point = $this->getDecimalPoint();

        return number_format($value, $length, $point, $separator);
    }
}