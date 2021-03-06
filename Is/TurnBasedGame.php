<?php

namespace GeorgetteParty\GMFBundle\Is;

/**
 * A contract for a class being a Turn Based Game,
 * as far as the GMF cares
 *
 * There is nothing for now, it's okay,
 * this is mostly used for strict typing.
 *
 * Interface Game
 * @package GeorgetteParty\GMFBundle\Is
 */
interface TurnBasedGame extends Game
{

    public function isTurnOf(Player $player);
    public function endOfTurn(Player $player);

}