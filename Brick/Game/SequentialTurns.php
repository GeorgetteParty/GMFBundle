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
//    abstract public function getPlayers();

    /**
     * The current player
     *
     * This is problematic, as this annotation should not be in the GMF !
     *
     * Tried (without success)
     * - a lot :(
     * - overriding this property
     * - making my own Trait, use-ing this one
     *
     * Either don't use annotations or don't use Traits...
     * The only thing I think we can do is to make our own AnnotationDriver,
     * and configure in the header of the class something like
     * ODM\Property(name="current_player", type="ReferenceOne", [...])
     *
     * @ODM\ReferenceOne(
     *     targetDocument="Aego\AegoBundle\Document\GoPlayer"
     * )
     */
    private $current_player;

    /**
     * A Collection (or vanilla array) of players.
     * See thoughts above.
     *
     * @ODM\ReferenceMany(
     *     targetDocument="Aego\AegoBundle\Document\GoPlayer",
     *     cascade={"all"},
     *     mappedBy="game"
     * )
     */
    protected $players = [];

    /**
     * Returns an array of Players
     *
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * TODO: rename addPlayer(), use with care
     * @param Player $player
     */
    public function addPlayerUnchecked(Player $player)
    {
        $this->players[] = $player;
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
     * @throws InvalidArgumentException
     */
    public function nextPlayer()
    {
        $players = $this->getPlayers();

        $k = $this->getIndexOfPlayer($this->getCurrentPlayer());

        $nextPlayer = $players[(($k+1)%count($players))];

        $this->setCurrentPlayer($nextPlayer);
    }

    protected function getIndexOfPlayer(Player $player)
    {
        $players = $this->getPlayers();

        if ($players instanceof Collection) {
            $k = $players->indexOf($player);
        } else {
            $k = array_search($player, $players, true);
        }

        return $k;
    }

    /**
     * @param Player $current_player
     */
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

}
