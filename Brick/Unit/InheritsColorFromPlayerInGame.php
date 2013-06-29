<?php

namespace GeorgetteParty\GMFBundle\Brick\Unit;

use GeorgetteParty\GMFBundle\Is\Colorized;
use GeorgetteParty\GMFBundle\Is\OfPlayer;
use GeorgetteParty\GMFBundle\Is\OfGame;
use GeorgetteParty\GMFBundle\Is\Color;

/**
 * Use this to implement Colorized.
 *
 * /!\
 * Requires OfPlayer and OfGame interfaces.
 *
 * (?)
 * How do we "officialize" this ?
 * Below is a suggestion :
 *
 * @implements Colorized
 * @requires OfPlayer
 * @requires OfGame
 */
trait InheritsColorFromPlayerInGame
{
    /**
     * Inherits the color from the player in the game
     * @return Color
     */
    public function getColor()
    {
        return $this->getGame()->getColor($this->getPlayer());
    }
}
