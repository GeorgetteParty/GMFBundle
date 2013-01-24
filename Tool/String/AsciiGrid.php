<?php

namespace Gmf\GmfBundle\Tool\String;


/**
 * Please set :
 * mb_internal_encoding('UTF-8');
 *
 * @author Goutte
 */
class AsciiGrid
{
    static public function toArray($string)
    {
        return array(); // fixme
    }

    /**
     * Converts passed $array to its ascii grid representation
     *
     * @param $array
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

        // Compute the horizontal separator
        $gridLine = "+";
        for ($i=0; $i<$nbOfCols; $i++) {
            $gridLine .= "---+";
        }

        // For each row ...
        $grid = '';
        foreach ($array as $row) {
            if (!is_array($row)) $row = array($row);

            $grid .= $gridLine . "\n";
            $grid .= "|";

            // For each col ...
            foreach ($row as $col) {
                $letter = mb_substr((string)$col, 0, 1);

                if (0 == strlen($letter)) $letter = ' ';
                $grid .= " {$letter} |";
            }

            $grid .= "\n";
        }

        // Add the ending horizontal separator
        $grid .= $gridLine;

        return $grid;
    }
}