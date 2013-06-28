<?php

namespace Goutte\QuadsphereGoBundle\Brick\Unit;

use Goutte\QuadsphereGoBundle\Is\Colorized;
use Goutte\QuadsphereGoBundle\Is\OfPlayer;
use Goutte\QuadsphereGoBundle\Is\OfGame;
use Goutte\QuadsphereGoBundle\Is\Color;

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
