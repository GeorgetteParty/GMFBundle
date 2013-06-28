<?php

namespace Goutte\QuadsphereGoBundle\Brick\Unit;

use Exception;
use Goutte\QuadsphereGoBundle\Space\Coordinates;

/**
 * Bare-bones way of having an id as parameter
 */
trait IdAsParameter // implements Identifiable
{
    protected $id = null;

    public function getId()
    {
        if (null == $this->id) {
            throw new Exception("This object has no ID yet,");
        }

        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}
