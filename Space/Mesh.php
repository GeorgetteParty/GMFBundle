<?php
namespace GeorgetteParty\GMFBundle\Space;

use GeorgetteParty\GMFBundle\Space\Geometry;

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
