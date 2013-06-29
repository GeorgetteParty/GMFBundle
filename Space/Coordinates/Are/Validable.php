<?php

namespace GeorgetteParty\GMFBundle\Space\Coordinates\Are;

use GeorgetteParty\GMFBundle\Exception\InvalidCoordinatesException;

/**
 * If your Coordinates implement this, the CoordinatesSystem will run it
 * for you when appropriate.
 *
 * Interface Validable
 * @package GeorgetteParty\GMFBundle\Space
 */
interface Validable
{
    /**
     * Validates the components of the coordinates.
     * Make your own, or use one of the Traits (eg: ValidateAsIntegers)
     *
     * Should throw InvalidCoordinatesException when invalid.
     * Should not return anything.
     *
     * The CS has its own validate() for the presence of these coordinates in it
     * but it will run this before to type-check and stuff.
     *
     * @throws InvalidCoordinatesException When it does not validate
     */
    public function validate();
}
