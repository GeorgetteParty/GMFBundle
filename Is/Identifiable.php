<?php

namespace Goutte\QuadsphereGoBundle\Is;

/**
 * For Moves for instance
 *
 * Any Identifiable Move played by the Game using Game#playMove(Move)
 * will be set an auto-incrementing id by the Game.
 *
 * Interface Identifiable
 * @package Goutte\QuadsphereGoBundle\Is
 */
interface Identifiable {
    public function getId();
    public function setId($id);
}