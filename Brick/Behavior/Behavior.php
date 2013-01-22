<?php

namespace Gmf\GmfBundle\Brick\Behavior;

use Gmf\GmfBundle\Event\Event;
use Gmf\GmfBundle\Event\Listener;
use Symfony\Component\EventDispatcher\EventDispatcher;

// I don't know if it's useful
class Behavior
{
    public function doSomething()
    {
        //$listener = new Listener();
        //$this->eventDispatcher->addListener(Event::GAMECORE_INIT, array($listener, 'onGamecoreInit'));
    }
}
