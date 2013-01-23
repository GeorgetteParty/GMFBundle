<?php
namespace Gmf\GmfBundle\Space;

/**
 * Vector3
 *
 * @author lutangar
 */
class Vector3 extends Vector2
{
    protected $z;

    /**
     * @param $x
     * @param $y
     * @param $z
     */
    public function __construct($x, $y, $z) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }
}
