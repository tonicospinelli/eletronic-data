<?php

namespace EletronicData\Format;

use EletronicData\Format\Exception\ConvertionException;

class DateFormat extends AbstractFormat
{

    const FORMAT_YYYYMMDD = 'Ymd';

    const FORMAT_YYYYMM = 'Ym';

    const FORMAT_DDMMYYYY = 'dmY';

    const FORMAT_MMDDYYYY = 'mdY';

    protected $format;

    public function __construct()
    {
        $this->setFormat(self::FORMAT_YYYYMMDD);
    }

    /**
     * Sets format to convert the date.
     *
     * @param string $format can be DateFormat::FORMAT_YYYYMMDD, DateFormat::FORMAT_DDMMYYYY,
     *                       or DateFormat::FORMAT_YYYYMMDD. If it is not specified it is assumed
     *                       to be DateFormat::FORMAT_YYYYMMDD.
     *
     * @return DateFormat
     * @throws \InvalidArgumentException
     */
    public function setFormat($format)
    {
        switch ($format) {
            case self::FORMAT_DDMMYYYY:
            case self::FORMAT_MMDDYYYY:
            case self::FORMAT_YYYYMMDD:
            case self::FORMAT_YYYYMM:
                $this->format = $format;
                break;
            default:
                throw new \InvalidArgumentException('The given format ' . $format . ' is not recognized');
        }
        return $this;
    }

    /**
     * Gets format to convert the date.
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @inheritdoc
     */
    public function convert($value)
    {
        if (!($value instanceof \DateTime)) {
            $value = preg_replace('/[T\s].*$/', '', $value);
            $value = \DateTime::createFromFormat('Y-m-d', $value);
        }

        if (!($value instanceof \DateTime)) {
            throw new ConvertionException('The value given cannot be converted to \DateTime object.');
        }

        return $value->format($this->getFormat());
    }
}