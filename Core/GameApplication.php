<?php

namespace Gmf\GmfBundle\Core;

class GameApplication
{
    /**
     * @var GameEngine[]
     */
    protected $engines = array();

    /**
     * Create new games engines
     */
    public function __construct()
    {
        //TODO get engines from configuration, parameters ?
        $this->engines[] = new GameEngine();
    }

    /**
     * Initialize games engines
     */
    public function init()
    {
        foreach ($this->engines as $engine) {
            $engine->init();
        }
    }

    /**
     * Returns current applications engines
     * @return GameEngine[]
     */
    public function getEngines()
    {
        return $this->engines;
    }
}