<?php

namespace PositionalData\Segment;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PositionalData\Field\FieldInterface;

abstract class AbstractSegment implements SegmentInterface
{

    /**
     * @var Collection
     */
    protected $fields;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    /**
     * @inheritdoc
     */
    public function addField(FieldInterface $field)
    {
        if (is_null($field->getSequential())) {
            $field->setSequential($this->getFields()->count());
        }
        $this->fields->add($field);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setFields(Collection $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @inheritdoc
     */
    public function toString($separator = '')
    {
        $string = '';

        $fields = $this->sortFieldsBy('sequential');

        foreach ($fields as $field) {
            if (!empty($string)) {
                $string .= $separator;
            }
            $string .= $this->trim($field->getFormattedValue(), $separator);
        }

        return $string;
    }

    /**
     * @param string $property
     *
     * @return \Traversable
     */
    public function sortFieldsBy($property)
    {
        $fields = $this->getFields()->getIterator();

        $fields->uasort(function ($a, $b) use ($property) {
            $method = 'get' . ucfirst($property);

            return ($a->$method() == $b->$method() ? 0 : ($a->$method() > $b->$method() ? 1 : -1));
        });

        return $fields;
    }

    /**
     * Trim value if not have seaprator.
     *
     * @param string $value
     * @param string $separator
     *
     * @return string
     */
    protected function trim($value, $separator)
    {
        return (empty($separator) ? $value : trim($value));
    }
}
