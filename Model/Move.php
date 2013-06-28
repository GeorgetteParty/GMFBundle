<?php

namespace Goutte\QuadsphereGoBundle\Model;

use Goutte\QuadsphereGoBundle\Brick\Unit\GameAsParameter;
use Goutte\QuadsphereGoBundle\Brick\Unit\PlayerAsParameter;
use Goutte\QuadsphereGoBundle\Is\Game;
use Goutte\QuadsphereGoBundle\Is\OfGame;
use Goutte\QuadsphereGoBundle\Is\Player;
use Goutte\QuadsphereGoBundle\Is\OfPlayer;

/**
 * Made by a Player, in a Game.
 * Extend this class to make your own Move
 * if your Game uses Moves.
 *
 * A Game executes Moves.
 *
 * Class Move
 * @package Goutte\QuadsphereGoBundle\Model
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