<?php

namespace Goutte\QuadsphereGoBundle\Space\Coordinates;

/**
 * XYZ api for Coordinates with (at least) 3 numeric components.
 *
 * There's no actual Interface for this yet. It's more like sugar.
 *
 * Use on Coordinates. Look at `QuadsphereFacesCoordinates`.
 *
 * Trait Cartesian3D
 */
trait Cartesian3D
{

    /**
     * @return integer
     */
    public function getX()
    {
        return $this[0];
    }

    /**
     * @param integer $x
     */
    public function setX($x)
    {
        $this[0] = $x;
    }

    /**
     * @return integer
     */
    public function getY()
    {
        return $this[1];
    }

    /**
     * @param integer $y
     */
    public function setY($y)
    {
        $this[1] = $y;
    }

    /**
     * @return integer
     */
    public function getZ()
    {
        return $this[2];
    }

    /**
     * @param integer $z
     */
    public function setZ($z)
    {
        $this[2] = $z;
    }

}
