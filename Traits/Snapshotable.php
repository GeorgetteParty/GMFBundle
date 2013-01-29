<?php

namespace Gmf\GmfBundle\Traits;

trait Snapshotable
{
    public function save()
    {
        return serialize($this);
    }
}