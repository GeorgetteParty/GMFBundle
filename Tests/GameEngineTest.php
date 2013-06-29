<?php

namespace GeorgetteParty\GMFBundle\Tests\Core;

use GeorgetteParty\GMFBundle\Core\GameEngine;

class GameEngineTests extends \PHPUnit_Framework_TestCase
{
    /**
     * Engine should initialize games cores
     */
    public function testInit()
    {
        $engine = new GameEngine();
        $cores = $engine->getCores();

        $this->assertTrue(count($cores) > 0, 'GameEngine failed to run games cores!');
    }
}