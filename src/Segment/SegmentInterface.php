<?php

namespace PositionalData\Segment;

use Doctrine\Common\Collections\Collection;
use PositionalData\Field\FieldInterface;

interface SegmentInterface
{

    /**
     * Adds new field.
     *
     * @param FieldInterface $field
     *
     * @return SegmentInterface
     */
    public function addField(FieldInterface $field);

    /**
     * Sets a field collection.
     *
     * @param Collection $fields
     *
     * @return SegmentInterface
     */
    public function setFields(Collection $fields);

    /**
     * Gets a field collection.
     * @return Collection
     */
    public function getFields();
}