<?php

namespace GeorgetteParty\GMFBundle\Brick;

use GeorgetteParty\GMFBundle\Brick\Behavior\Behavior;
use GeorgetteParty\GMFBundle\Model\Game\Brick;
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