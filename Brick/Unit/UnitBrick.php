<?php

namespace Gmf\GmfBundle\Brick\Unit;

use Gmf\GmfBundle\Brick\GameBrick;

class UnitBrick extends GameBrick
{
    //TODO bind this to model ?
    protected $name;

    protected $life;

    public function getName()
    {
        return $this->name;
    }

    public function getLife()
    {
        return $this->life;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLife($life)
    {
        $this->life = $life;
    }
}
