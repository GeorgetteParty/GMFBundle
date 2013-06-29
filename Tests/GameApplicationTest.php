<?php

namespace GeorgetteParty\GMFBundle\Tests\Core;

use GeorgetteParty\GMFBundle\Core\GameApplication;
use GeorgetteParty\GMFBundle\Core\GameEngine;

class GameApplicationTests extends \PHPUnit_Framework_TestCase
{
    /**
     * Application should initialize games engines
     */
    public function testInit()
    {
        $application = new GameApplication();
        $engines = $application->getEngines();

        $this->assertTrue(count($engines) > 0, 'GameApplication failed to run games engines!');
    }
}