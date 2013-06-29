<?php

namespace GeorgetteParty\GMFBundle\Space\Coordinates;

use GeorgetteParty\GMFBundle\Exception\InvalidCoordinatesException;
use GeorgetteParty\GMFBundle\Space\Coordinates;


/**
 * Makes sure all coordinates components are integers
 * Use on Coordinates
 *
 * Trait ValidateAsIntegers
 * @package GeorgetteParty\GMFBundle\Space\Coordinates
 */
trait ValidateAsIntegers // implements Validable
{
    /**
     * Throws if one component is not an integer
     *
     * @throws InvalidCoordinatesException
     * @return void
     */
    public function validate()
    {
        $validate = true;

        foreach ($this as $v) {
            if (!is_integer($v)) $validate = false;
        }

        if (!$validate) {
            throw new InvalidCoordinatesException($this);
        }
    }
}
