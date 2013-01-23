<?php
namespace Gmf\GmfBundle\Space;

use Gmf\GmfBundle\Space\Geometry;

/**
 * Mesh
 *
 * @author lutangar
 */
class Mesh
{
    protected $geometry;

    /**
     * @param $geometry
     */
    public function __construct($geometry) {
        $this->geometry = $geometry;
    }

    public function getGeometry() {

    }
}
