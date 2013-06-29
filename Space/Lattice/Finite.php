<?php

namespace GeorgetteParty\GMFBundle\Space\Lattice;

use GeorgetteParty\GMFBundle\Space\Cell;

interface Finite extends Bounded
{
    /**
     * All cells, sorted as you wish (tothink)
     *
     * @return Cell[]
     */
    public function getCells();
}