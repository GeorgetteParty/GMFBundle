<?php


namespace Gmf\GmfBundle\Tests\Tool\String;

use Gmf\GmfBundle\Tool\String\AsciiGrid;

// cool link : http://recessiondodgetovictory.wordpress.com/2011/01/12/ascii-chessboard/
// table generator: http://www.sensefulsolutions.com/2010/10/format-text-as-table.html (use Unicode Art)
// text generator : http://www.network-science.de/ascii/ and http://patorjk.com/software/taag/

/**
 * @author Goutte
 */
class AsciiGridTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    /**
     * @param $message
     * @param $array
     * @param $expected
     *
     * @return void
     * @dataProvider arrayToStringProvider
     */
    public function testToString($message, $array, $expected)
    {
        $actual = AsciiGrid::toString($array);

        $this->assertEquals($expected, $actual, $message);
    }

    /**
     * @param $message
     * @param $expected
     * @param $string
     *
     * @return void
     * @dataProvider stringToArrayProvider
     */
    public function testToArray($message, $expected, $string)
    {
        $actual = AsciiGrid::toArray($string);

        $this->assertEquals($expected, $actual, $message);
    }


    public function arrayToStringProvider()
    {
        $r = array(
            array(
                "It should convert an unidimensional array into a column",
                array('A', 'B'),
                <<<EOF
+---+
| A |
+---+
| B |
+---+
EOF
            ),
            array(
                "It should convert an array with a single element into a single cell",
                array('A'),
                <<<EOF
+---+
| A |
+---+
EOF
            ),
            array(
                "It should convert an non-array into a single cell",
                'A',
                <<<EOF
+---+
| A |
+---+
EOF
            ),
        );

        return array_merge($this->reciprocalTransformationProvider(), $r);
    }


    public function stringToArrayProvider()
    {
        $r = array(

            array(
                "It should read bigger cells and concatenate multiline content",
                array(array('CAPBAC', 'P'), array('B', 'DK')),
                <<<EOF
+-----+-----+
| CAP |  P  |
| BAC |     |
+-----+-----+
|     |  D  |
|  B  |  K  |
+-----+-----+
EOF
            ),

        );

        return array_merge($this->reciprocalTransformationProvider(), $r);
    }


    public function reciprocalTransformationProvider()
    {
        return array(

            array(
                "It should interpret NULL as an empty cell",
                array(array(null)),
                <<<EOF
+---+
|   |
+---+
EOF
            ),
            array(
                "It should convert single-cell grids",
                array(array('A')),
                <<<EOF
+---+
| A |
+---+
EOF
            ),
            array(
                "It should work with integers",
                array(array('7')),
                <<<EOF
+---+
| 7 |
+---+
EOF
            ),
            array(
                "It should work with the pipe symbol (|)",
                array(array('|')),
                <<<EOF
+---+
| | |
+---+
EOF
            ),
            array(
                "It should work with the plus symbol (+)",
                array(array('+')),
                <<<EOF
+---+
| + |
+---+
EOF
            ),
            array(
                "It should work with the minus symbol (-)",
                array(array('-')),
                <<<EOF
+---+
| - |
+---+
EOF
            ),
            array(
                "It should work with any unicode character, if using mb_internal_encoding('UTF-8')",
                array(array('☯')),
                <<<EOF
+---+
| ☯ |
+---+
EOF
            ),
            array(
                "It should work with single-column grids",
                array(array('A'), array('B')),
                <<<EOF
+---+
| A |
+---+
| B |
+---+
EOF
            ),
            array(
                "It should work with single-row grids",
                array(array('A', 'B')),
                <<<EOF
+---+---+
| A | B |
+---+---+
EOF
            ),
            array(
                "It should read rows and then columns",
                array(array('A', 'B'), array(null, 'D')),
                <<<EOF
+---+---+
| A | B |
+---+---+
|   | D |
+---+---+
EOF
            ),

        );
    }

}



// DUMP ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$asciiGrid = <<<EOF
+---+---+
| A |   |
+---+---+
|   | D |
+---+---+
EOF;

        $asciiGrid = <<<EOF
+---+---+
| A |   |
+---+---+
|   | D |
+---+---+
EOF;

        $asciiGrid = <<<EOF
+-----+-----+
|     |     |
|     |     |
+-----+-----+
|     |     |
|     |     |
+-----+-----+
EOF;

        $asciiGrid = <<<EOF
+-------+-------+
|       |       |
| LUCKY |  777  |
|       |       |
+-------+-------+
|       |       |
| EARTH |  (+)  |
|       |       |
+-------+-------+
EOF;

        $asciiGrid = <<<EOF
+---------+---------+
|         |         |
|         |         |
|         |         |
|         |         |
+---------+---------+
|         |         |
|         |         |
|         |         |
|         |         |
+---------+---------+
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

$caca = 'prout';




