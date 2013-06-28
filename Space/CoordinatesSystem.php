<?php

namespace Goutte\QuadsphereGoBundle\Space;

/**
 * A Space may make use of a CoordinatesSystem
 */
interface CoordinatesSystem
{
    public function getNeighbors(Coordinates $coordinates);
}
