<?php

namespace GeorgetteParty\GMFBundle\Features\Bootstrap;

use Behat\Behat\Exception\BehaviorException;
use GeorgetteParty\GMFBundle\Model\GoPlayer;

trait I
{

    /**
     * @var GoPlayer
     */
    protected $I;

    public function I()
    {
        if (empty($this->I)) {
            throw new BehaviorException("There's no I !");
        }
        return $this->I;
    }

}