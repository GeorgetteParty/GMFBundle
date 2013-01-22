<?php

namespace Gmf\GmfBundle\Space;

interface Lattice
{
    /**
     * Returns an array of Cells
     *
     * @param  Cell $cell
     * @return Cell[]
     */
    public function findAdjacentOf(Cell $cell);
}