<?php

namespace Gmf\GmfBundle\Tool\String;

if (!function_exists('strpos_recursive')) {
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

if (!function_exists('mb_str_pad')) {
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

    /**
     * @param  string $string
     * @return array
     */
    static public function toArray($string)
    {
        $arrayOfLines = explode(PHP_EOL, $string);

        if (0 == count($arrayOfLines)) return array();

        $grid = array();

        // fixme

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

        $grid = '';

        // fixme

        return $grid;
    }

}