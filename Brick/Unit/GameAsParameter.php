<?php

namespace Goutte\QuadsphereGoBundle\Brick\Unit;

use Goutte\QuadsphereGoBundle\Is\Game;

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
