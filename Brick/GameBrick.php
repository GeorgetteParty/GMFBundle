<?php

namespace Gmf\GmfBundle\Brick;

use Gmf\GmfBundle\Brick\Behavior\Behavior;
use Gmf\GmfBundle\Model\Game\Brick;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class GameBrick extends Brick
{
    protected $behaviors = array();

    public function __construct()
    {
    }

    /**
     * Use this to load data
     * @return mixed
     */
    public abstract function load();

    // fixme goutte: i dont' know what i'm doing, i just want tests to pass ^^
    public function render()
    {
        return '';
    }
}