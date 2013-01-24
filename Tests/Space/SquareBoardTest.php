<?php

/*
   ______            __  __
  / ____/___  __  __/ /_/ /____
 / / __/ __ \/ / / / __/ __/ _ \
/ /_/ / /_/ / /_/ / /_/ /_/  __/
\____/\____/\__,_/\__/\__/\___/

 */

namespace Gmf\GmfBundle\Tests\Space;

class SquareBoard implements \Gmf\GmfBundle\Space\Lattice
{
    use \Gmf\GmfBundle\Space\Lattice\Tesselation\Dimension2\Grid;
}

class SquareBoardTest extends \PHPUnit_Framework_TestCase
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

        // dumping some ascii/unicode grids
        // cool link : http://recessiondodgetovictory.wordpress.com/2011/01/12/ascii-chessboard/
        // table generator: http://www.sensefulsolutions.com/2010/10/format-text-as-table.html (use Unicode Art)
        // text generator : http://www.network-science.de/ascii/ and http://patorjk.com/software/taag/

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




