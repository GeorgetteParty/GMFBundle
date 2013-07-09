<?php

namespace GeorgetteParty\GMFBundle\Brick\Game;

use GeorgetteParty\GMFBundle\Is\Player;

/**
 *
 *
 * Trait PlayersAsArrayParameter
 * @package GeorgetteParty\GMFBundle\Brick\Unit
 */
trait PlayersAsArrayParameter // implements (part of) Game
{

    /**
     * @ODM\ReferenceMany(targetDocument="Aego\AegoBundle\Document\GoPlayer")
     */
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
