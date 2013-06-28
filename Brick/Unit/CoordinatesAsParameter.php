<?php

namespace Goutte\QuadsphereGoBundle\Brick\Unit;

use Goutte\QuadsphereGoBundle\Space\Coordinates;

/**
 * Use this, and then
 * add dependency in your `__construct` :
 * $this->coordinates = $coordinates;
 */
trait CoordinatesAsParameter
{
    /**
     * @var Coordinates
     */
    protected $coordinates;

    /**
     * todo: what about validation ?
     * @param Coordinates|array $coordinates
     */
    public function setCoordinates(Coordinates $coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * @return Coordinates|array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
}
