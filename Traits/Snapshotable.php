<?php

namespace Gmf\GmfBundle\Traits;

trait Snapshotable // implements \Gmf\GmfBundle\Interfaces\Snapshotable
{
    public function save()
    {
        return serialize($this);
    }
}