<?php

namespace Gmf\GmfBundle\Core;
//use Gmf\GmfBundle\Model\Game\Engine as BaseGameEngine;

/**
 *
 * @author
 * @author
 */
class GameEngine// extends BaseGameEngine
{
    /**
     * @var GameCore[]
     */
    protected $cores = array();

    public function __construct()
    {
        $this->cores[] = new GameCore();
    }

    public function init()
    {
        foreach ($this->cores as $core) {
            $core->init();
        }
    }

    /**
     * Load Cores
     */
    public function load()
    {
        foreach ($this->cores as $core) {
            $core->load();
        }
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