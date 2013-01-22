<?php

namespace Gmf\GmfBundle\Event;

use Symfony\Component\EventDispatcher\Event as BaseEvent;

class Event extends BaseEvent
{
    const GAMECORE_INIT = 'gamecore.init';
    const GAMECORE_LOAD = 'gamecore.load';
}
