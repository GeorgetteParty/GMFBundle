<?php

namespace Gmf\GmfBundle\Space\Lattice;

use Gmf\GmfBundle\Space\Cell;

interface Bounded
{
    /**
     * @param Cell $cell
     * @return boolean
     */
    public function isWithinBoundaries(Cell $cell);
}