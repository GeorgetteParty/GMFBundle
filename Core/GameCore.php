<?php

namespace Gmf\GmfBundle\Core;

use Gmf\GmfBundle\Brick\GameBrick;
use Gmf\GmfBundle\Event\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GameCore
{
    /**
     * @var GameBrick[]
     */
    protected $bricks;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    public function __construct()
    {
        $this->eventDispatcher = new EventDispatcher();
    }

    public function init()
    {
        $this->bricks = array();
        $this->eventDispatcher->dispatch(Event::GAMECORE_INIT, new Event());
    }

    /**
     * Load bricks, to get data for example.
     * It's useful to have all data load in the same events to make a "huge" loading
     * at beginning and none after
     */
    public function load()
    {
        $initEvent = new Event();

        foreach ($this->bricks as $brick) {
            $brick->load();
        }
        $this->eventDispatcher->dispatch(Event::GAMECORE_LOAD, $initEvent);
    }

    public function render()
    {
        $render = '';

        return $render;
    }

    public function addBrick(GameBrick $brick)
    {
        $this->bricks[] = $brick;
    }

    public function getBricks()
    {
        return $this->bricks;
    }

    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }
}