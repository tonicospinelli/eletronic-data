<?php

namespace PositionalData\Document;

use Doctrine\Common\Collections\Collection;
use PositionalData\Segment\SegmentInterface;

interface DocumentInterface
{

    /**
     * Sets end of line.
     *
     * @param string $eof
     *
     * @return DocumentInterface
     */
    public function setEndOfLine($eof);

    /**
     * Gets end of line.
     * If not set, it use PHP_EOL.
     * @return string
     */
    public function getEndOfLine();

    /**
     * @param Collection $segments
     *
     * @return DocumentInterface
     */
    public function setSegments(Collection $segments);

    /**
     * @return Collection|SegmentInterface[]
     */
    public function getSegments();

    /**
     * @param SegmentInterface $segment
     *
     * @return DocumentInterface
     */
    public function addSegment(SegmentInterface $segment);

    /**
     * Convert document to string with field separator.
     *
     * @param string $separator
     *
     * @return string
     */
    public function toString($separator = '');
}
