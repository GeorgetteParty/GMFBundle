<?php

namespace Gmf\GmfBundle\Core;

use Gmf\GmfBundle\Model\Game\Core as BaseGameCore;
use Gmf\GmfBundle\Brick\ViewBrick;

use Gmf\GmfBundle\Brick\GameBrick;
//use Gmf\GmfBundle\Brick\ViewBrick;
use Gmf\GmfBundle\Event\Event;
use Gmf\GmfBundle\Event\Listener;
use Gmf\GmfBundle\Exception\RenderException;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GameCore
{
    /**
     * @var GameBrick[]
     */
    protected $bricks = array();

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var ViewBrick[]
     */
    protected $viewBricks = array();

    public function __construct()
    {
        $listener = new Listener();
        $this->eventDispatcher = new EventDispatcher();
    }

    public function init()
    {
        $initEvent = new Event();
        $this->eventDispatcher->dispatch(Event::GAMECORE_INIT, $initEvent);
    }


    /**
     * Load bricks, to get data for example.
     * It's useful to have all data load in the same events to make a "huge" loading
     * at beginning and none after
     */
    public function load()
    {
        foreach ($this->bricks as $brick) {
            $brick->load();
        }
    }

    public function render()
    {
        $render = '';

        if (!count($this->viewBricks)) {
            throw new RenderException('CoreRender failed. No ViewBrick was found');
        }
        foreach ($this->viewBricks as $brick) {
            $render .= $brick->render();
        }
        return $render;
    }

    public function addBrick(GameBrick $brick)
    {
        if ($brick instanceof ViewBrick) {
            $this->viewBricks[] = $brick;
        }
        $this->bricks[] = $brick;
    }

    public function getBricks()
    {
        return $this->bricks;
    }
}