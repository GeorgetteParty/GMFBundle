<?php

namespace Goutte\QuadsphereGoBundle\Space;

use ArrayObject;

/**
 * This is an attempt to do the OO way for what could be a simple flat array of values
 * Extending ArrayObject
 *
 * Class Coordinates
 * @package Goutte\QuadsphereGoBundle\Space
 */
class Coordinates extends ArrayObject
{
    /**
     * Returns the coordinates as string :
     * ( <1st cmpnt>, <2nd cmpnt>, etc. )
     *
     * @return string
     */
    public function __toString()
    {
        return '( ' . join(', ', (array)$this) . ' )';
    }
}