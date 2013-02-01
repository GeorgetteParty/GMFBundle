<?php

namespace Gmf\GmfBundle\Core;

use Gmf\GmfBundle\Brick\GameBrick;
use Gmf\GmfBundle\Event\Event;
use Gmf\GmfBundle\Traits\Dispatchable;
use Gmf\GmfBundle\Traits\Snapshotable;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GameCore
{
    /**
     * Dispatchable: GameCore should be able to dispatch event and register listeners
     * Snapshotable: GameCore should be able to load and save his context
     */
    use Dispatchable, Snapshotable;

    /**
     * @var GameBrick[]
     */
    protected $bricks;


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
}