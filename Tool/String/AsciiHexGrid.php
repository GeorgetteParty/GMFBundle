<?php

namespace Gmf\GmfBundle\Tool\String;

if (!defined('PHP_INT_MIN')) {
    define('PHP_INT_MIN', ~PHP_INT_MAX);
}

if (!function_exists(__NAMESPACE__.'\\'.'strpos_recursive')) {
    /**
     * Returns an array of the positions of $nedle in $haystack, starting at $offset
     *
     * @param string $haystack
     * @param string $needle
     * @param int    $offset
     * @param array  $results
     * @return array
     */
    function strpos_recursive($haystack, $needle, $offset = 0, &$results = array())
    {
        $offset = strpos($haystack, $needle, $offset);
        if (false === $offset) {
            return $results;
        } else {
            $results[] = $offset;

            return strpos_recursive($haystack, $needle, ($offset + 1), $results);
        }
    }
}

if (!function_exists(__NAMESPACE__.'\\'.'mb_str_pad')) {
    /**
     * Multibyte-friendly str_pad
     *
     * @param $input
     * @param $pad_length
     * @param string $pad_string
     * @param int $pad_type
     * @return string
     */
    function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
    {
        return str_pad($input, $pad_length + strlen($input) - mb_strlen($input), $pad_string, $pad_type);
    }
}

/**
 * Manages the conversion between simple ascii hex grids and PHP arrays
 *
 * Please set (if you are using Unicode characters) :
 * mb_internal_encoding('UTF-8');
 *
 * See Gmf\GmfBundle\Tests\Tool\String\AsciiHexGridTest for documentation on how this behaves
 *
 * @author Goutte
 */
class AsciiHexGrid
{
    const BOX_DRAWING_HORIZONTAL_LINE = '_';
    const BOX_DRAWING_DIAGONAL_BL2UR  = '/';
    const BOX_DRAWING_DIAGONAL_BR2UL  = '\\';

    const SIZE = 5;

    /**
     * @param  string $string
     * @return array
     * @throws InvalidAsciiGridException
     */
    static public function toArray($string)
    {
        $arrayOfLines = explode(PHP_EOL, $string);

        if (0 == count($arrayOfLines)) return array();

        $grid = array();

        $horizontalSeparator = str_repeat(self::BOX_DRAWING_HORIZONTAL_LINE, self::SIZE);

        // Detect the origin (topmost and then leftmost)
        $originLeftPos = mb_strpos($arrayOfLines[0], $horizontalSeparator);
        if (false === $originLeftPos) throw new InvalidAsciiGridException();
        $originContent = self::extractContentOfCellWhoseTopLeftIs(0, $originLeftPos, $arrayOfLines);
        self::addCellTo3DArray($grid, 0, 0, 0, $originContent);

        $n = 0;
        while (isset($arrayOfLines[$n])) {
            $line = $arrayOfLines[$n];
            $positions = strpos_recursive($line, $horizontalSeparator);

            foreach ($positions as $position) {
                if (0 === $n && $position === $originLeftPos) continue;

                if (isset($arrayOfLines[$n+4]) && mb_substr($arrayOfLines[$n+4], $position, self::SIZE) == $horizontalSeparator) {
                    $content = self::extractContentOfCellWhoseTopLeftIs($n, $position, $arrayOfLines);
                    $x = ($position - $originLeftPos) / (self::SIZE + 2);
                    $y = -1 * (2 * $x + $n) / 4;
                    $z = -1 * ($x+$y);
                    self::addCellTo3DArray($grid, $x, $y, $z, $content);
                }
            }

            $n += 2;
        }

        return $grid;
    }

    static protected function extractContentOfCellWhoseTopLeftIs($top, $left, $arrayOfLines)
    {
        $line1 = trim(mb_substr($arrayOfLines[$top+2], $left, self::SIZE));
        $line2 = trim(mb_substr($arrayOfLines[$top+3], $left, self::SIZE));

        $content = $line1;

        if (mb_strlen($line2)) $content .= ' ' . $line2;

        return $content;
    }

    static protected function addCellTo3DArray(&$array, $x, $y, $z, $value)
    {
        if (!isset($array[$x]))        $array[$x] = array();
        if (!isset($array[$x][$y]))    $array[$x][$y] = array();
        if (isset($array[$x][$y][$z])) throw new \Exception("There already is a value at {$x}/{$y}/{$z}.");

        $array[$x][$y][$z] = $value;
    }

    /**
     * Converts passed $array to its ascii grid representation
     *
     * @param  array $array
     * @return string
     */
    static public function toString($array)
    {
        if (!is_array($array)) $array = array(0=>array(0=>array(0=>$array)));

        $grid = array();

        foreach ($array as $x => $xArray) {
            foreach ($xArray as $y => $yArray) {
                foreach ($yArray as $z => $value) {
                    $a = $x * 7;
                    $b = 0; // fixme
                    self::writeHexagonIntoArray($grid, $a, $b, $value);
                }
            }
        }



        $xMin = $yMin = PHP_INT_MAX;
        $xMax = $yMax = PHP_INT_MIN;
        foreach ($grid as $x => $row) {
            $xMin = min($x, $xMin);
            $xMax = max($x, $xMax);
            foreach ($row as $y => $col) {
                $yMin = min($y, $yMin);
                $yMax = max($y, $yMax);
            }
        }

        $string = '';

        for ($y=$yMin; $y<=$yMax; $y++) {
            for ($x=$xMin; $x<=$xMax; $x++) {
                if (isset($grid[$x][$y])) {
                    $string .= $grid[$x][$y];
                } else {
                    $string .= ' ';
                }
            }
            $string = rtrim($string);

            if ($y < $yMax) $string .= PHP_EOL;
        }

        return $string;
    }

    static protected function writeHexagonIntoArray(&$array, $x, $y, $value)
    {
        $size = self::SIZE;

        // top & bottom sides
        for ($i=0; $i<$size; $i++) {
            self::addCellTo2DArray($array, $x+$i, $y,   self::BOX_DRAWING_HORIZONTAL_LINE);
            self::addCellTo2DArray($array, $x+$i, $y+4, self::BOX_DRAWING_HORIZONTAL_LINE);
        }

        // left side
        self::addCellTo2DArray($array, $x-1, $y+1, self::BOX_DRAWING_DIAGONAL_BL2UR);
        self::addCellTo2DArray($array, $x-2, $y+2, self::BOX_DRAWING_DIAGONAL_BL2UR);
        self::addCellTo2DArray($array, $x-2, $y+3, self::BOX_DRAWING_DIAGONAL_BR2UL);
        self::addCellTo2DArray($array, $x-1, $y+4, self::BOX_DRAWING_DIAGONAL_BR2UL);

        // right side
        self::addCellTo2DArray($array, $x+$size+0, $y+1, self::BOX_DRAWING_DIAGONAL_BR2UL);
        self::addCellTo2DArray($array, $x+$size+1, $y+2, self::BOX_DRAWING_DIAGONAL_BR2UL);
        self::addCellTo2DArray($array, $x+$size+1, $y+3, self::BOX_DRAWING_DIAGONAL_BL2UR);
        self::addCellTo2DArray($array, $x+$size+0, $y+4, self::BOX_DRAWING_DIAGONAL_BL2UR);

        // value
        if (mb_strlen($value) > $size) {

            // fixme
            $value1 = mb_str_pad($value, $size, ' ', STR_PAD_BOTH);
            $value2 = mb_str_pad('',     $size, ' ', STR_PAD_BOTH);

        } else {
            $value1 = mb_str_pad($value, $size, ' ', STR_PAD_BOTH);
            $value2 = mb_str_pad('',     $size, ' ', STR_PAD_BOTH);
        }
        for ($i=0; $i<$size; $i++) {
            self::addCellTo2DArray($array, $x+$i, $y+2, mb_substr($value1, $i, 1));
            self::addCellTo2DArray($array, $x+$i, $y+3, mb_substr($value2, $i, 1));
        }

    }


    static protected function addCellTo2DArray(&$array, $x, $y, $value)
    {
        if (!isset($array[$x]))    $array[$x] = array();
        if (isset($array[$x][$y])) throw new \Exception("There already is a value at {$x}/{$y}.");

        $array[$x][$y] = $value;
    }

}