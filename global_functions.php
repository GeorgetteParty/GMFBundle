<?php

/**
 * This file exists because functions in namespaces are a world of hurt.
 * Some functions deserve a place as globals, when they're consistent with the inbuilt php functions.
 * Prefer Static methods when it makes sense.
 *
 * Functions should be sorted alphabetically.
 *
 * Maths deserve a place as global.
 * Array manipulation too.
 */


/**
 * Pushes $value into $array only if $value is not already in it.
 * This is merely a convenience wrapper for the `in_array` check.
 *
 * @param array $array
 * @param mixed $value
 */
function array_push_once (&$array, $value)
{
    if (!in_array($value, $array)) {
        $array[] = $value;
    }
}


/**
 * Rotates passed array $offset times to the left, like a cycle would.
 * You can only use this with numerically-indexed arrays.
 * Note that it mutates the provided array.
 *
 * Eg:
 * $a = array(7,8,9);
 * array_rotate_left($a,1); // array(8,9,7)
 *
 * @param array $array The array to rotate
 * @param int $offset When negative, rotates to the right
 * @throws \Exception
 */
function array_rotate_left (&$array, $offset=0) {

    for (reset($array); is_int(key($array)); next($array));
    if (!is_null(key($array))) {
        throw new Exception("Can only rotate numeric arrays");
    }

    $l = count($array);
    $offset = ( $l + ($offset % $l) ) % $l;

    while ($offset--) {
        $first = array_shift($array);
        $array[] = $first;
    }

}


/**
 * Obvious
 * We all wrote that line at some point.
 * (Ongoing Poll: 1/1 = 100%)
 *
 * @param $value
 * @param $min
 * @param $max
 * @return mixed
 */
function boundarize ($value, $min, $max)
{
    return min($max, max($min, $value));
}


/**
 * Is $n an even number ?
 * Is it even a number ? ^.^
 *
 * @param $n
 * @return bool
 * @throws Exception
 */
function even($n)
{
    if (!is_integer($n)) throw new Exception((string)$n." is not an integer");
    return $n % 2 === 0;
}


/**
 * Is $n an odd number ?
 * The odd Zero is even !
 *
 * @param $n
 * @return bool
 */
function odd($n)
{
    return !even($n);
}


/**
 * Returns +1 for a positive $number,
 *         -1 for a negative $number,
 *          0 for 0.
 *
 * Throws on unsupported $number.
 *
 * @param number $number
 * @return int
 * @throws Exception
 */
function norm ($number)
{
    if ($number === 0) {
        return 0;
    } else if ($number > 0) {
        return 1;
    } else if ($number < 0) {
        return -1;
    }
    throw new Exception("Unsupported number $number");
}

