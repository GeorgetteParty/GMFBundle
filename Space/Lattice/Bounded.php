<?php

namespace GeorgetteParty\GMFBundle\Space\Lattice;

use GeorgetteParty\GMFBundle\Space\Cell;

interface Bounded
{
    /**
     * @param Cell $cell
     * @return boolean
     */
    public function isWithinBoundaries(Cell $cell);
}