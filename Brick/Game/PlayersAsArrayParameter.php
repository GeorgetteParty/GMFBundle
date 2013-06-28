<?php

namespace Goutte\QuadsphereGoBundle\Brick\Game;

use Goutte\QuadsphereGoBundle\Is\Player;

/**
 *
 *
 * Trait PlayersAsArrayParameter
 * @package Goutte\QuadsphereGoBundle\Brick\Unit
 */
trait PlayersAsArrayParameter // implements (part of) Game
{

    protected $players = array();

    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    /**
     * Returns an array of Players
     *
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

}
