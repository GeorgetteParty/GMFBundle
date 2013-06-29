<?php

namespace GeorgetteParty\GMFBundle\Brick\Unit;

use GeorgetteParty\GMFBundle\Is\Game;

/**
 * Use this, and then
 * add dependency in your `__construct` :
 * $this->game = $game;
 */
trait GameAsParameter
{
    protected $game;

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }
}
