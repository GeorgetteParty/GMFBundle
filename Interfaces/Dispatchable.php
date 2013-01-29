<?php

namespace Gmf\GmfBundle\Interfaces;

use Gmf\GmfBundle\Event\Event;
use Gmf\GmfBundle\Event\Listener;
use Symfony\Component\EventDispatcher\EventDispatcher;

interface Dispatchable
{
    /**
     * Return current event dispatcher
     * @return EventDispatcher
     */
    public function getEventDispatcher();

    public function setEventDispatcher(EventDispatcher $eventDispatcher);

    public function addListener($eventName, Listener $listener, $methodName);

    public function dispatch(Event $event);
}