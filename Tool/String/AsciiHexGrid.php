<?php

namespace Gmf\GmfBundle\Tool\String;

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
        self::addCellToArray($grid, 0, 0, 0, $originContent);


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
                    self::addCellToArray($grid, $x, $y, $z, $content);
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

    static protected function addCellToArray(&$array, $x, $y, $z, $value)
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
        if (!is_array($array)) $array = array($array);

        $grid = '';

        // fixme

        return $grid;
    }

}