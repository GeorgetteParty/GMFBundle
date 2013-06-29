<?php

namespace GeorgetteParty\GMFBundle\Space;

/**
 * A Space may make use of a CoordinatesSystem
 */
interface CoordinatesSystem
{
    public function getNeighbors(Coordinates $coordinates);
}
