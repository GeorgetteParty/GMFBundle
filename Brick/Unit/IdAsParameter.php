<?php

namespace GeorgetteParty\GMFBundle\Brick\Unit;

use GeorgetteParty\GMFBundle\Space\Coordinates;

/**
 * Bare-bones way of having an id as parameter,
 * and providing the ODM with necessary annotations
 */
trait IdAsParameter // implements Identifiable
{

    /**
     * Auto-generated unique string ID, eg: '51d625e55688a9df2ab79f48'
     * @ODM\Id
     */
    protected $id;

    public function getId()
    {
        if (null === $this->id) {
            throw new \BadMethodCallException("This object has no ID yet,");
        }

        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}
