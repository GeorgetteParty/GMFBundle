<?php

namespace Goutte\QuadsphereGoBundle\Space;

use Goutte\QuadsphereGoBundle\Space\Coordinates;

/**
 * Implement in any object that has variable coordinates in space.
 * The GMF Lattice (or something higher, like the Board ?)
 * may have a method `addObject(Positionable $p)`
 *
 * Interface Movable
 * @package Goutte\QuadsphereGoBundle\Is
 */
interface Movable extends Positionable
{
    /**
     * @param Coordinates|array $coordinates
     * @return mixed
     */
    public function setCoordinates(Coordinates $coordinates);
}