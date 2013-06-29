<?php

/*
   ______            __  __
  / ____/___  __  __/ /_/ /____
 / / __/ __ \/ / / / __/ __/ _ \
/ /_/ / /_/ / /_/ / /_/ /_/  __/
\____/\____/\__,_/\__/\__/\___/

 */

namespace GeorgetteParty\GMFBundle\Tests\Space;

class SquareBoard implements \GeorgetteParty\GMFBundle\Space\Lattice
{
    use \GeorgetteParty\GMFBundle\Space\Lattice\Tesselation\Dimension2\Grid;
}

class SquareBoardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SquareBoard
     */
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
        // do "corners" count as adjacency ? -- Assume yes

        // dumping some ascii/unicode grids

        $asciiSquareBoard = <<<EOF
+---+---+---+---+---+---+---+---+
| a | b | c | d | e | f | g | h |
+---+---+---+---+---+---+---+---+
| i | j | k | l | m | n | o | p |
+---+---+---+---+---+---+---+---+
| q | r | s | t | u | v | w | x |
+---+---+---+---+---+---+---+---+
| y | z | 0 | 3 | 4 | 7 | 8 | . |
+---+---+---+---+---+---+---+---+
| Y | Z | 1 | 2 | 5 | 6 | 9 | 0 |
+---+---+---+---+---+---+---+---+
| Q | R | S | T | U | V | W | X |
+---+---+---+---+---+---+---+---+
| I | J | K | L | M | N | O | P |
+---+---+---+---+---+---+---+---+
| A | B | C | D | E | F | G | H |
+---+---+---+---+---+---+---+---+
EOF;

        $asciiChessBoard = <<<EOF
+---+---+---+---+---+---+---+---+
| ♜ | ♞ | ♝ | ♛ | ♚ | ♝ | ♞ | ♜ |
+---+---+---+---+---+---+---+---+
| ♟ | ♟ | ♟ | ♟ | ♟ | ♟ | ♟ | ♟ |
+---+---+---+---+---+---+---+---+
|   |   |   |   |   |   |   |   |
+---+---+---+---+---+---+---+---+
|   |   |   |   |   |   |   |   |
+---+---+---+---+---+---+---+---+
|   |   |   |   |   |   |   |   |
+---+---+---+---+---+---+---+---+
|   |   |   |   |   |   |   |   |
+---+---+---+---+---+---+---+---+
| ♙ | ♙ | ♙ | ♙ | ♙ | ♙ | ♙ | ♙ |
+---+---+---+---+---+---+---+---+
| ♖ | ♘ | ♗ | ♕ | ♔ | ♗ | ♘ | ♖ |
+---+---+---+---+---+---+---+---+
EOF;

    }
}




