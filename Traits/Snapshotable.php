<?php

namespace GeorgetteParty\GMFBundle\Traits;

trait Snapshotable // implements \GeorgetteParty\GMFBundle\Interfaces\Snapshotable
{
    public function save()
    {
        return serialize($this);
    }
}