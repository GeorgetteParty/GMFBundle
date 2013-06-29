<?php

namespace GeorgetteParty\GMFBundle\Is;

/**
 * For Stone and StoneGroup right now.
 * This is GMF-oriented
 *
 * Interface OfGame
 * @package GeorgetteParty\GMFBundle\Is
 */
interface OfGame {
    /**
     * @return Game
     */
    public function getGame();
}