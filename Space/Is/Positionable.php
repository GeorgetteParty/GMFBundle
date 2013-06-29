<?php

namespace GeorgetteParty\GMFBundle\Space\Is;

use GeorgetteParty\GMFBundle\Space\Coordinates;

/**
 * Implement in any object that has coordinates in space.
 * The Space interface has a method `addObject(Positionable $o)`
 *
 * I also like Spatial, as a name.
 *
 * Interface Positionable
 * @package GeorgetteParty\GMFBundle\Is
 */
interface Positionable
{
    /**
     * @return Coordinates|null
     */
    public function getCoordinates();
}