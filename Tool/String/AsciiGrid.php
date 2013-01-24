<?php

namespace Gmf\GmfBundle\Tool\String;

/**
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

//        // Guess the number of columns by counting the first line's BOX_DRAWING_INTERSECTION
//        $nbOfCols = substr_count($string, self::BOX_DRAWING_INTERSECTION) - 1;
//
//        // Guess the number of rows by counting the lines that start with BOX_DRAWING_INTERSECTION
//        $nbOfRows = 0;
//        foreach ($arrayOfLines as $line) {
//            if (self::BOX_DRAWING_INTERSECTION == substr($line, 0, 1)) {
//                $nbOfRows++;
//            }
//        }
//        $nbOfRows--;

        $grid = array();
        $row = null;

        foreach ($arrayOfLines as $line) {
            if (self::BOX_DRAWING_INTERSECTION == substr($line, 0, 1)) { // horizontal separator line
                if (null !== $row) $grid[] = $row;
                $row = array();
            } else { // data line
                $data = explode(self::BOX_DRAWING_VERTICAL_LINE, $line);
                foreach ($data as $k => $v) {
                    if ($k > 0 && $k < count($data) - 1) { // first and last are garbage
                        $row[] = trim($v);
                    }
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