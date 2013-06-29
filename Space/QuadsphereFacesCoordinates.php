<?php

namespace GeorgetteParty\GMFBundle\Space;

use GeorgetteParty\GMFBundle\Space\Coordinates;
use GeorgetteParty\GMFBundle\Space\Coordinates\Are\Validable;
use GeorgetteParty\GMFBundle\Space\Coordinates\ValidateAsIntegers;
use GeorgetteParty\GMFBundle\Space\Coordinates\Cartesian3D;

/**
 * Our chosen implementation of coordinates for
 * the lattice of the faces of a quadsphere.
 *
 * Responsibilities
 * - be an ArrayObject (with all its perks)
 * - validate the internal C.S.
 * - provide convenient accessors
 *
 * Class QuadsphereFacesCoordinates
 * @package GeorgetteParty\GMFBundle\Space
 */
class QuadsphereFacesCoordinates extends Coordinates implements Validable
{

    use ValidateAsIntegers;
    use Cartesian3D;

}
