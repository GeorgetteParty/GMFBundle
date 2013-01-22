<?php

namespace Gmf\GmfBundle\Brick;

use Gmf\GmfBundle\Model\Game\Brick;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * EventBrick can bind bricks to core events
 */
abstract class EventBrick extends Brick
{
    /**
     * Register events in core dispatcher
     * @param EventDispatcher $eventDispatcher
     * @return mixed
     */
    public abstract function register(EventDispatcher $eventDispatcher);
}