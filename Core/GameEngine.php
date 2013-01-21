<?php

namespace Gmf\GmfBundle\Core;
use Gmf\GmfBundle\Model\Game\Engine as BaseGameEngine;

/**
 *
 * @author
 * @author
 */
class GameEngine extends BaseGameEngine
{
    protected $cores = array();

    public function __construct()
    {
        $this->cores[] = new GameCore();
    }

    /**
     * Return engine's gamecore
     * @return GameCore[]
     */
    public function getCores()
    {
        return $this->cores;
    }
}