<?php

namespace Goutte\QuadsphereGoBundle\Is;

/**
 * For Stone and StoneGroup right now.
 * This is GMF-oriented
 *
 * Interface OfGame
 * @package Goutte\QuadsphereGoBundle\Is
 */
interface OfGame {
    /**
     * @return Game
     */
    public function getGame();
}