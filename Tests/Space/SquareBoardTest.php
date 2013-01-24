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
        // do "corners" count as adjacency ?

        // dumping some ascii grids
        // cool link : http://recessiondodgetovictory.wordpress.com/2011/01/12/ascii-chessboard/
        // cool generator: http://www.sensefulsolutions.com/2010/10/format-text-as-table.html (use Unicode Art)

$asciiGrid = <<<EOF
+---+---+
|   |   |
+---+---+
|   |   |
+---+---+
EOF;


$unicodeGrid = <<<EOF
┌───┬───┐
│   │   │
├───┼───┤
│   │   │
└───┴───┘
EOF;


$unicodeGrid = <<<EOF
┌─────┬─────┐
│     │     │
│     │     │
├─────┼─────┤
│     │     │
│     │     │
└─────┴─────┘
EOF;


$unicodeGrid = <<<EOF
┌───────┬───────┐
│       │       │
│       │       │
│       │       │
├───────┼───────┤
│       │       │
│       │       │
│       │       │
└───────┴───────┘
EOF;



$unicodeGrid = <<<EOF
╔═══╦═══╗
║   ║   ║
╠═══╬═══╣
║   ║   ║
╚═══╩═══╝
EOF;

    }
}




