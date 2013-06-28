<?php

namespace Goutte\QuadsphereGoBundle\Space\Is;

use Goutte\QuadsphereGoBundle\Space\Coordinates;

/**
 * Implement in any object that has coordinates in space.
 * The Space interface has a method `addObject(Positionable $o)`
 *
 * I also like Spatial, as a name.
 *
 * Interface Positionable
 * @package Goutte\QuadsphereGoBundle\Is
 */
interface Positionable
{
    /**
     * @return Coordinates|null
     */
    public function getCoordinates();
}