<?php

namespace Gmf\GmfBundle\Tool\String;

if (!function_exists('strpos_recursive')) {
    /**
     * Returns an array of the positions of $nedle in $haystack, starting at $offset
     *
     * @param $haystack
     * @param $needle
     * @param int $offset
     * @param array $results
     * @return array
     */
    function strpos_recursive($haystack, $needle, $offset = 0, &$results = array())
    {
        $offset = strpos($haystack, $needle, $offset);
        if ($offset === false) {
            return $results;
        } else {
            $results[] = $offset;

            return strpos_recursive($haystack, $needle, ($offset + 1), $results);
        }
    }
}

/**
 * Manages the conversion between simple ascii grids and 2D arrays
 *
 * Please set :
 * mb_internal_encoding('UTF-8');
 *
 * See Gmf\GmfBundle\Tests\Tool\String\AsciiGridTest for documentation on how this behaves
 *
 * @author Goutte
 */
class AsciiGrid
{
    const BOX_DRAWING_INTERSECTION    = '+';
    const BOX_DRAWING_HORIZONTAL_LINE = '-';
    const BOX_DRAWING_VERTICAL_LINE   = '|';

    /**
     * @param  string $string
     * @return array
     */
    static public function toArray($string)
    {
        $arrayOfLines = explode(PHP_EOL, $string);

        if (0 == count($arrayOfLines)) return array();

        // Get the positions of the vertical separators
        $posOfVerticalSeparators = strpos_recursive($arrayOfLines[0], self::BOX_DRAWING_INTERSECTION);

        /* (useless for now)

        // Guess the number of columns by counting the first line's BOX_DRAWING_INTERSECTION
        $nbOfCols = substr_count($arrayOfLines[0], self::BOX_DRAWING_INTERSECTION) - 1;

        // Guess the number of rows by counting the lines that start with BOX_DRAWING_INTERSECTION
        $nbOfRows = 0;
        foreach ($arrayOfLines as $line) {
            if (self::BOX_DRAWING_INTERSECTION == substr($line, 0, 1)) {
                $nbOfRows++;
            }
        }
        $nbOfRows--;
        */

        $grid = array(); $row = null;

        foreach ($arrayOfLines as $line) {
            if (self::BOX_DRAWING_INTERSECTION == substr($line, 0, 1)) { // horizontal separator line
                if (null !== $row) $grid[] = $row;
                $row = array();
            } else { // data line
                $startPos = 0;
                foreach ($posOfVerticalSeparators as $k => $endPos) {
                    if ($k > 0) {
                        $data = trim(mb_substr($line, $startPos+1, $endPos-$startPos-1));
                        $row[$k-1] = (isset($row[$k-1]) ? $row[$k-1] : '') . $data;
                    }
                    $startPos = $endPos;
                }
            }
        }


        return $grid;
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

        // Count the max number of cols
        $nbOfCols = 0;
        foreach ($array as $row) {
            if (!is_array($row)) $row = array($row);

            $nbOfCols = max($nbOfCols, count($row));
        }

        if ($nbOfCols < 1) return '';

        // Compute the horizontal separator between rows
        $gridLine = self::BOX_DRAWING_INTERSECTION;
        for ($i=0; $i<$nbOfCols; $i++) {
            $gridLine .= str_repeat(self::BOX_DRAWING_HORIZONTAL_LINE, 3) . self::BOX_DRAWING_INTERSECTION;
        }

        // For each row ...
        $grid = '';
        foreach ($array as $row) {
            if (!is_array($row)) $row = array($row);

            $grid .= $gridLine . PHP_EOL;
            $grid .= self::BOX_DRAWING_VERTICAL_LINE;

            // For each col ...
            foreach ($row as $col) {
                $letter = mb_substr((string)$col, 0, 1);

                if (0 == strlen($letter)) $letter = ' ';
                $grid .= " {$letter} " . self::BOX_DRAWING_VERTICAL_LINE;
            }

            $grid .= PHP_EOL;
        }

        // Add the ending horizontal separator
        $grid .= $gridLine;

        return $grid;
    }
}