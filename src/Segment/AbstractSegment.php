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

        $fields = $this->getFields()->getIterator();
        $fields->uasort(function ($a, $b) {
            return ($a->getSequential() == $b->getSequential() ? 0 : ($a->getSequential() > $b->getSequential() ? 1 : -1));
        });

        foreach ($fields as $field) {
            if (!empty($string)) {
                $string .= $separator;
            }
            $string .= $field->getFormattedValue();
        }

        return $string;
    }
}
