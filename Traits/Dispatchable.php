<?php

namespace GeorgetteParty\GMFBundle\Traits;

use GeorgetteParty\GMFBundle\Event\Event;
use GeorgetteParty\GMFBundle\Event\Listener;
use Symfony\Component\EventDispatcher\EventDispatcher;

trait Dispatchable // implements \GeorgetteParty\GMFBundle\Interfaces\Dispatchable
{
    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * Return current event dispatcher
     * @return EventDispatcher
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    public function setEventDispatcher(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function addListener($eventName, Listener $listener, $methodName)
    {
        $this->getEventDispatcher()->addListener($eventName, array($listener, $methodName));
    }

    public function dispatch(Event $event)
    {
        $this->getEventDispatcher()->dispatch($event->getName(), $event);
    }
}