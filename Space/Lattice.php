<?php

namespace Gmf\GmfBundle\Space;

interface Lattice
{
    /**
     * Returns an array of Cells adjacent with passed $cell
     *
     * @param  Cell $cell
     * @return Cell[]
     */
    public function findAdjacentOf(Cell $cell); // findByAdjacencyTo ? <- more Doctrine-like, a Lattice being somewhat a Repository for Cells
}