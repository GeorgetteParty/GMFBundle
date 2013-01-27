<?php

namespace Gmf\GmfBundle\Brick;

use Gmf\GmfBundle\Brick\Behavior\Behavior;
use Gmf\GmfBundle\Model\Game\Brick;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GameBrick extends Brick
{
    protected $behaviors = array();

    public function __construct()
    {
    }

    /**
     * Use this to load data
     * @return mixed
     */
    public function load()
    {
    }
}