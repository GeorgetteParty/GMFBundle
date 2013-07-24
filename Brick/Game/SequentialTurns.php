<?php

namespace GeorgetteParty\GMFBundle\Brick\Game;

use Doctrine\Common\Collections\Collection;
use InvalidArgumentException;
use GeorgetteParty\GMFBundle\Is\Player;

trait SequentialTurns // implements TurnBasedGame
{
    /**
     * Should return an array of Players
     * This is like requiring the Interface Game
     * @return Player[]
     */
    abstract public function getPlayers();

    /**
     * This is problematic, as this annotation should not be in the GMF !
     * I tried many many many different things, without success :(
     *
     * The only thing I could find was either
     * not to use annotations or not to use Traits...
     *
     * Tried
     * - overriding this property
     * - making my own Trait, use-ing this one
     *
     * @ODM\ReferenceOne(
     *     targetDocument="Aego\AegoBundle\Document\GoPlayer"
     * )
     */
    private $current_player;

    public function setCurrentPlayer($current_player)
    {
        $this->current_player = $current_player;
    }

    /**
     * @return Player
     */
    public function getCurrentPlayer()
    {
        return $this->current_player;
    }


    /**
     * When nobody played, it's the turn of anybody.
     *
     * @param Player $player
     * @return bool
     */
    public function isTurnOf(Player $player)
    {
        $cp = $this->getCurrentPlayer();

        return $cp == null || $cp === $player;
    }


    /**
     * Moves to next Player
     *
     * @param Player $player
     * @throws InvalidArgumentException
     */
    public function endOfTurn(Player $player)
    {
        $players = $this->getPlayers();

        if ($players instanceof Collection) {
            $k = $players->indexOf($player);
        } else {
            $k = array_search($player, $players, true);
        }

        if (false === $k) {
            throw new InvalidArgumentException("This player is not in the game");
        }

        $nextPlayer = $players[(($k+1)%count($players))];

        $this->setCurrentPlayer($nextPlayer);
    }

}
