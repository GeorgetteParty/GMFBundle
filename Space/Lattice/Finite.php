<?php

namespace Gmf\GmfBundle\Space\Lattice;

use Gmf\GmfBundle\Space\Cell;

interface Finite extends Bounded
{
    /**
     * All cells, sorted as you wish (tothink)
     *
     * @return Cell[]
     */
    public function getCells();
}