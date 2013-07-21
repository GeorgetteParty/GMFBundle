<?php

namespace GeorgetteParty\GMFBundle\Brick\Unit;

use GeorgetteParty\GMFBundle\Is\Player;

/**
 * Use this, and then
 * add dependency in your `__construct` :
 * $this->player = $player;
 */
trait PlayerAsParameter
{

    protected $player;

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
}
