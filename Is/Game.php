<?php

namespace Goutte\QuadsphereGoBundle\Is;

/**
 * A contract for a class being a Game,
 * as far as the GMF cares
 *
 * This might be used by the GMF's Application layer
 *
 * Interface Game
 * @package Goutte\QuadsphereGoBundle\Is
 */
interface Game {

    public function addPlayer(Player $player);
    public function getPlayers();

}