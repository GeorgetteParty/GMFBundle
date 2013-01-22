<?php

namespace Gmf\GmfBundle\Space\Lattice\Tesselation\Dimension2;

use Gmf\GmfBundle\Space\Cell;

trait Grid // implements Lattice
{
    public function findAdjacentOf(Cell $cell)
    {
        // it requires the Cell's position to be convertible into a 2D Vector
        // It computes the adjacent position's 2D Vectors
        // it asks its Memory~ for existing Cells at these positions
        //   - Memory~ as DI ? (as abstract function)
        //   - or Trait ?

        return array(); // fixme
    }
}