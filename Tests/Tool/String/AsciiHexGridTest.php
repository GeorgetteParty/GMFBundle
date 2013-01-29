<?php


namespace Gmf\GmfBundle\Tests\Tool\String;

use Gmf\GmfBundle\Tool\String\AsciiHexGrid;

// http://www-cs-students.stanford.edu/~amitp/Articles/Hexagon2.html

/**
 * @author Goutte
 */
class AsciiHexGridTest extends \PHPUnit_Framework_TestCase
{

    public function setUp() {}

    public function tearDown() {}

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
        $actual = AsciiHexGrid::toString($array);

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
        $actual = AsciiHexGrid::toArray($string);

        $this->assertEquals($expected, $actual, $message);
    }


    public function arrayToStringProvider()
    {
        $r = array(
            array(
                "It should convert an unidimensional array into a column",
                array('A', 'B'),
                <<<EOF
  _____
 /     \
/   A   \
\       /
 \_____/
 /     \
/   B   \
\       /
 \_____/
EOF
            ),
            array(
                "It should convert an array with a single element into a single cell",
                array('A'),
                <<<EOF
  _____
 /     \
/   A   \
\       /
 \_____/
EOF
            ),
            array(
                "It should convert an non-array into a single cell",
                'A',
                <<<EOF
  _____
 /     \
/   A   \
\       /
 \_____/
EOF
            ),
            array(
                "It should interpret NULL as an empty cell",
                array(0 => array(0 => array(0 => null))),
                <<<EOF
  _____
 /     \
/       \
\       /
 \_____/
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
                "It should interpret an empty string as an empty cell",
                array(
                    0 => array(
                        0 => array(
                            0 => '',
                        ),
                    ),
                ),
                <<<EOF
  _____
 /     \
/       \
\       /
 \_____/
EOF
            ),
            array(
                "It should convert single-cell grids",
                array(
                    0 => array(
                        0 => array(
                            0 => 'A',
                        ),
                    ),
                ),
                <<<EOF
  _____
 /     \
/   A   \
\       /
 \_____/
EOF
            ),
            array(
                "It should work with integers",
                array(
                    0 => array(
                        0 => array(
                            0 => '7',
                        ),
                    ),
                ),
                <<<EOF
  _____
 /     \
/   7   \
\       /
 \_____/
EOF
            ),
            array(
                "It should work with the underscore symbol (_)",
                array(
                    0 => array(
                        0 => array(
                            0 => '_____',
                        ),
                    ),
                ),
                <<<EOF
  _____
 /     \
/ _____ \
\       /
 \_____/
EOF
            ),
            array(
                "It should work with the slash symbol (/)",
                array(
                    0 => array(
                        0 => array(
                            0 => '/',
                        ),
                    ),
                ),
                <<<EOF
  _____
 /     \
/   /   \
\       /
 \_____/
EOF
            ),
            array(
                "It should work with the antislash symbol (\\)",
                array(
                    0 => array(
                        0 => array(
                            0 => '\\',
                        ),
                    ),
                ),
                <<<EOF
  _____
 /     \
/   \   \
\       /
 \_____/
EOF
            ),
            array(
                "It should work with any unicode character, if using mb_internal_encoding('UTF-8')",
                array(
                    0 => array(
                        0 => array(
                            0 => '☯',
                        ),
                    ),
                ),

                <<<EOF
  _____
 /     \
/   ☯   \
\       /
 \_____/
EOF
            ),
            array(
                "It should position the origin on the topmost/leftmost cell",
                array(
                    0 => array(
                        0 => array(
                            0 => 'A',
                        ),
                    ),
                    -1 => array(
                        0 => array(
                            1 => 'B',
                        ),
                    ),
                    1 => array(
                        -1 => array(
                            0 => 'C',
                        ),
                    ),
                ),
                <<<EOF
         _____
        /     \
  _____/   A   \_____
 /     \       /     \
/   B   \_____/   C   \
\       /     \       /
 \_____/       \_____/
EOF
            ),

        );
    }

}






// DUMP ////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$asciiHexGrid = <<<EOF
  ____
 /    \
/      \
\      /
 \____/

EOF;

$asciiHexGrid = <<<EOF
  _____
 /     \
/       \
\       /
 \_____/

EOF;

$asciiHexGrid = <<<EOF
        ____
       /    \
  ____/      \____
 /    \      /    \
/      \____/      \
\      /    \      /
 \____/      \____/
 /    \      /    \
/      \____/      \
\      /    \      /
 \____/      \____/
      \      /
       \____/

EOF;

$asciiHexGrid = <<<EOF
         _____
        /     \
  _____/       \_____
 /     \       /     \
/       \_____/       \
\       /     \       /
 \_____/       \_____/
 /     \       /     \
/       \_____/       \
\       /     \       /
 \_____/       \_____/
       \       /
        \_____/

EOF;

$asciiHexGrid = <<<EOF
        ____        ____
       /    \      /    \
  ____/      \____/      \
 /    \      /    \      /
/      \____/      \____/
\      /    \      /    \
 \____/      \____/      \
 /    \      /    \      /
/      \____/      \____/
\      /    \      /    \
 \____/      \____/      \
      \      /    \      /
       \____/      \____/

EOF;



$unicodeHexGrid = <<<EOF
        ____
       ╱    ╲
  ____╱      ╲____
 ╱    ╲      ╱    ╲
╱      ╲____╱      ╲
╲      ╱    ╲      ╱
 ╲____╱      ╲____╱
 ╱    ╲      ╱    ╲
╱      ╲____╱      ╲
╲      ╱    ╲      ╱
 ╲____╱      ╲____╱
      ╲      ╱
       ╲____╱

EOF;

$unicodeHexGrid = <<<EOF
         _____
        ╱     ╲
  _____╱       ╲_____
 ╱     ╲       ╱     ╲
╱       ╲_____╱       ╲
╲       ╱     ╲       ╱
 ╲_____╱       ╲_____╱
 ╱     ╲       ╱     ╲
╱       ╲_____╱       ╲
╲       ╱     ╲       ╱
 ╲_____╱       ╲_____╱
       ╲       ╱
        ╲_____╱

EOF;


// TwoPerpendicularAxisCoordinateSystem

$unicodeHexGrid = <<<EOF
           y
         _____
        ╱     ╲
  _____╱  0  2 ╲_____
 ╱     ╲       ╱     ╲
╱ -1  1 ╲_____╱  1  1 ╲
╲       ╱     ╲       ╱
 ╲_____╱  0  0 ╲_____╱   x
 ╱     ╲       ╱     ╲
╱ -1 -1 ╲_____╱  1 -1 ╲
╲       ╱     ╲       ╱
 ╲_____╱  0 -2 ╲_____╱
       ╲       ╱
        ╲_____╱

EOF;


// TwoAxisCoordinateSystem

$unicodeHexGrid = <<<EOF
           y
         _____
        ╱     ╲
  _____╱  0  1 ╲_____
 ╱     ╲       ╱     ╲ x
╱ -1  1 ╲_____╱  1  0 ╲
╲       ╱     ╲       ╱
 ╲_____╱  0  0 ╲_____╱
 ╱     ╲       ╱     ╲
╱ -1  0 ╲_____╱  1 -1 ╲
╲       ╱     ╲       ╱
 ╲_____╱  0 -1 ╲_____╱
       ╲       ╱
        ╲_____╱

EOF;


// ThreeSymmetricalAxisCoordinateSystem
// => the most elegant !
// x+y+z = 0

$unicodeHexGrid = <<<EOF
         _____
     y  ╱     ╲
  _____╱ 0 1-1 ╲_____
 ╱     ╲       ╱     ╲
╱-1 1 0 ╲_____╱ 1 0-1 ╲
╲       ╱     ╲       ╱
 ╲_____╱ 0 0 0 ╲_____╱  x
 ╱     ╲       ╱     ╲
╱-1 0 1 ╲_____╱ 1-1 0 ╲
╲       ╱     ╲       ╱
 ╲_____╱ 0-1 1 ╲_____╱
       ╲       ╱
    z   ╲_____╱

EOF;


$unicodeHexGrid = <<<EOF
                _____
       y       ╱     ╲
         _____╱ 0 2-2 ╲_____
        ╱     ╲       ╱     ╲
  _____╱-1 2-1 ╲_____╱ 1 1-2 ╲_____
 ╱     ╲       ╱     ╲       ╱     ╲
╱-2 2 0 ╲_____╱ 0 1-1 ╲_____╱ 2 0-2 ╲
╲       ╱     ╲       ╱     ╲       ╱
 ╲_____╱-1 1 0 ╲_____╱ 1 0-1 ╲_____╱
 ╱     ╲       ╱     ╲       ╱     ╲
╱-2 1 1 ╲_____╱ 0 0 0 ╲_____╱ 2-1-1 ╲  x
╲       ╱     ╲       ╱     ╲       ╱
 ╲_____╱-1 0 1 ╲_____╱ 1-1 0 ╲_____╱
 ╱     ╲       ╱     ╲       ╱     ╲
╱-2 0 2 ╲_____╱ 0-1 1 ╲_____╱ 2-2 0 ╲
╲       ╱     ╲       ╱     ╲       ╱
 ╲_____╱-1-1 2 ╲_____╱ 1-2 1 ╲_____╱
       ╲       ╱     ╲       ╱
        ╲_____╱ 0-2 2 ╲_____╱
              ╲       ╱
       z       ╲_____╱
EOF;





?>