<?php

namespace Goutte\QuadsphereGoBundle\Space;

use Goutte\QuadsphereGoBundle\Space\Coordinates;
use Goutte\QuadsphereGoBundle\Space\Coordinates\Are\Validable;
use Goutte\QuadsphereGoBundle\Space\Coordinates\ValidateAsIntegers;
use Goutte\QuadsphereGoBundle\Space\Coordinates\Cartesian3D;

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
 * @package Goutte\QuadsphereGoBundle\Space
 */
class QuadsphereFacesCoordinates extends Coordinates implements Validable
{

    use ValidateAsIntegers;
    use Cartesian3D;

}
