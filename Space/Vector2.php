<?php
namespace GeorgetteParty\GMFBundle\Space;

use GeorgetteParty\GMFBundle\Space\Vector;

/**
 * Vector2
 *
 * @author lutangar
 */
class Vector2 implements Vector
{
    protected $x;
    protected $y;

    /**
     * @param $x
     * @param $y
     */
    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
}
