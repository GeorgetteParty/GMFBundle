<?php

namespace Goutte\QuadsphereGoBundle\Util;

use Exception;

/**
 *
 * THESE SHOULD BE UNUSED
 * TO THE PROFIT OF global_functions.php
 *
 * If something deserves the global namespace, its maths. :)
 *
 * I dreamed of a language with all the constructs of mathematics embedded. <3
 * Some of these days...
 *
 * @deprecated
 *
 * Class Math
 * @package Goutte\QuadsphereGoBundle\Util
 */
class Math
{

    /**
     * Perfectly symmetrical PLUS operation.
     * This has nothing to do with Ægo, AFAIK.
     *
     * This is viewing the addition as going away from zero,
     * whatever the direction is (positive or negative).
     *
     * As you can see, this operator is an isomorphism of the "classic" one.
     * (to rephrase, probably)
     *
     * This operator is not commutative. (unlike the "classic" one)
     *
     * Instead of making the rules up from ground,
     * this function uses the existing operations.
     *
     * Assertions (symbols `+` and `-` are ps) :
     *
     *    3 +  2 =  5
     *   -3 +  2 = -5
     *    3 + -2 =  1
     *   -3 + -2 = -1
     *
     *    a + -b = a - b
     *
     * @link http://www.symmetryperfect.com/
     * @param int $a
     * @param int $b
     * @throws Exception
     * @return int
     */
    static function ps_plus($a, $b)
    {
        if (!is_integer($a) || !is_integer($b))
            throw new Exception("`".(string)$a."` or `".(string)$b."` is not an integer");

        if ($a < 0) {
            return $a - $b; // it's a ~hack somewhat, but it works
        } else {
            return $a + $b; // same as "classic" plus operation
        }
    }


    static function even($n)
    {
        if (!is_integer($n)) throw new Exception((string)$n." is not an integer");
        return $n % 2 === 0;
    }

    static function odd($n)
    {
        return !self::even($n);
    }

}
