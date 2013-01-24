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
     * @param $array
     * @param $expected
     *
     * @dataProvider arrayToStringProvider
     */
    public function testToString($array, $expected)
    {
        $actual = AsciiGrid::toString($array);

        $this->assertEquals($expected, $actual, "It should convert the array into the expected ascii grid");
    }

    /**
     * @param $expected
     * @param $string
     *
     * @dataProvider stringToArrayProvider
     */
    public function testToArray($expected, $string)
    {
        $actual = AsciiGrid::toArray($string);

        $this->assertEquals($expected, $actual, "It should convert the ascii grid string into the expected array");
    }


    public function arrayToStringProvider()
    {
        $r = array(
            array(
                array(false),
                <<<EOF
+---+
|   |
+---+
EOF
            ),
            array(
                array('A', 'B'),
                <<<EOF
+---+
| A |
+---+
| B |
+---+
EOF
            ),
        );

        return array_merge($this->reciprocalTransformationProvider(), $r);
    }


    public function stringToArrayProvider()
    {
        $r = array();

        return array_merge($this->reciprocalTransformationProvider(), $r);
    }


    public function reciprocalTransformationProvider()
    {
        return array(

            array(
                array(null),
                <<<EOF
+---+
|   |
+---+
EOF
            ),
            array(
                array('A'),
                <<<EOF
+---+
| A |
+---+
EOF
            ),
            array(
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
                array(array('A', 'B')),
                <<<EOF
+---+---+
| A | B |
+---+---+
EOF
            ),
            array(
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





