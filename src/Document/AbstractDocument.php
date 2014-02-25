<?php

namespace PositionalFile\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PositionalFile\Segment\SegmentInterface;

abstract class AbstractDocument implements DocumentInterface
{

    /**
     * @var string
     */
    protected $endOfLine;

    /**
     * @var Collection
     */
    protected $segments;

    public function __construct()
    {
        $this->segments = new ArrayCollection();
        $this->setEndOfLine(PHP_EOL);
    }

    /**
     * @inheritdoc
     */
    public function setEndOfLine($eof)
    {
        $this->endOfLine = $eof;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEndOfLine()
    {
        return $this->endOfLine;
    }

    /**
     * @inheritdoc
     */
    public function setSegments(Collection $segments)
    {
        $this->segments = $segments;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * @inheritdoc
     */
    public function addSegment(SegmentInterface $segment)
    {
        $this->segments->add($segment);

        return $this;
    }

    public function toString($separator = '')
    {
        $string = '';
        foreach ($this->getSegments() as $segment) {
            if (!empty($string)) {
                $string .= $this->getEndOfLine();
            }
            $string .= $segment->toString($separator);
        }

        return $string;
    }
}
