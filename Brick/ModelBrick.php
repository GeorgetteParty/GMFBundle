<?php

namespace Gmf\GmfBundle\Brick;

use Gmf\GmfBundle\Event\Event;
use Gmf\GmfBundle\Event\Listener;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ModelBrick extends EventBrick
{
    public function register(EventDispatcher $eventDispatcher)
    {
        $listener = new Listener($this);
        $eventDispatcher->addListener(Event::GAMECORE_LOAD, array($listener, 'onGamecoreLoad'));
    }

    public function notify($data)
    {

    }
}
