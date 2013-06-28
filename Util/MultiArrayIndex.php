<?php

namespace Goutte\QuadsphereGoBundle\Util;

use ArrayObject;

/**
 * Tools for multidimensional arrays
 * These arrays are used for Indexation
 *
 * Class MultiArrayIndex
 * @package Goutte\QuadsphereGoBundle\Util
 */
class MultiArrayIndex
{


    /**
     * Gets value in the array, at the specified $keys.
     * Returns null when not found.
     *
     * Eg:
     * using $keys = array('a','b','c')
     * is equivalent to $array['a']['b']['c']
     *
     * @param  array             $array
     * @param  array|ArrayObject $keys
     * @return mixed|null
     */
    static function get(&$array, $keys)
    {
        $keys = (array) $keys;
        for ($i =& $array; null !== $key = array_shift($keys); $i =& $i[$key]) {
            if (!isset($i[$key])) return null;
        }

        return $i;
    }

    /**
     * Mutates $value in the multidimensional array, at the specified $keys.
     * Creates subarrays if needed.
     *
     * Eg:
     * using $keys = array('a','b','c')
     * is equivalent to $array['a']['b']['c'] = $value
     *
     * @param array             $array
     * @param array|ArrayObject $keys
     * @param mixed             $value
     */
    static function set(&$array, $keys, $value)
    {
        $keys = (array) $keys;
        for ($i =& $array; null !== $key = array_shift($keys); $i =& $i[$key]) {
            if (!isset($i[$key])) $i[$key] = array();
        }
        $i = $value;
    }

    /**
     * Cleanly removes a value from the multidimensional array
     *
     * This method can be trimmed down. (it's tested, anyway)
     *
     * @param array $array
     * @param array|ArrayObject $keys
     * @param bool $_check Internal value used by recursion.
     *                     If this is false and there are arrays missing
     *                     along the "path" made by $keys, your world will burn.
     *
     */
    static function remove(&$array, $keys, $_check=true)
    {
        $keys = (array) $keys;

        if ($_check) {
            $keys2 = $keys;
            for ($i =& $array; null !== $key = array_shift($keys2); $i =& $i[$key]) {
                if (!isset($i[$key])) return;
            }
        }

        if (0 == count($keys)) {
            return;
        } else if (1 == count($keys)) {
            unset($array[array_shift($keys)]);
        } else {
            $key = array_shift($keys);
            self::remove($array[$key], $keys, false);
            if (empty($array[$key])) {
                unset($array[$key]);
            }
        }

    }

    /**
     * Sorts the array by increasing keys
     * Does not change the key => value association.
     *
     * @param  array $array
     * @return mixed
     */
    static function sortByKeys(&$array)
    {
        ksort($array, SORT_NUMERIC);
        foreach ($array as $kX => $rX) {
            ksort($array[$kX], SORT_NUMERIC);
        }
        foreach ($array as $kX => $rX) {
            foreach ($rX as $kY => $rY) {
                ksort($array[$kX][$kY], SORT_NUMERIC);
            }
        }

        return $array;
    }

}
