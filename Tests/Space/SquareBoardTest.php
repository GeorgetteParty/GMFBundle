<?php

namespace Gmf\GmfBundle\Tests\Space;

class SquareBoard implements \Gmf\GmfBundle\Space\Lattice
{
    use \Gmf\GmfBundle\Space\Lattice\Tesselation\Dimension2\Grid;
}

class SquareBoardTests extends \PHPUnit_Framework_TestCase
{
    protected $board;

    public function setUp()
    {
        $this->board = new SquareBoard();
    }

    public function tearDown()
    {
        unset($this->board);
    }

    /**
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testFindAdjacentOfNull()
    {
        $found = $this->board->findAdjacentOf(null);
    }

    public function testFindAdjacentOfOrigin()
    {
        // $cell = 2D-able Cell at [0,0]
        //$found = $this->board->findAdjacentOf($cell);
        // compare with {[-1,0],[0,1],[0,-1],[1,0]}

    }
}