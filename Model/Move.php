<?php

namespace GeorgetteParty\GMFBundle\Model;

use GeorgetteParty\GMFBundle\Brick\Unit\GameAsParameter;
use GeorgetteParty\GMFBundle\Brick\Unit\PlayerAsParameter;
use GeorgetteParty\GMFBundle\Is\Game;
use GeorgetteParty\GMFBundle\Is\OfGame;
use GeorgetteParty\GMFBundle\Is\Player;
use GeorgetteParty\GMFBundle\Is\OfPlayer;

/**
 * Made by a Player, in a Game.
 * Extend this class to make your own Move
 * if your Game uses Moves.
 *
 * A Game executes Moves.
 *
 * Class Move
 * @package GeorgetteParty\GMFBundle\Model
 */
class Move implements OfGame, OfPlayer
{

    use GameAsParameter;
    use PlayerAsParameter;

    public function __construct(Player $player, Game $game)
    {
        $this->game   = $game;
        $this->player = $player;
    }

}