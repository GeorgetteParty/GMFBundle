<?php

namespace Goutte\QuadsphereGoBundle\Exception;

/**
 * Can pass the array of coordinates (x,y,z) as second parameter,
 * it will be automatically dumped at the end of the message.
 *
 * Class IllegalMoveException
 * @package Goutte\QuadsphereGoBundle\Exception
 */
class IllegalMoveException extends \Exception
{
    public function __construct($message = "", $moveCoordinates = null, $code = 0, \Exception $previous = null)
    {
        if (is_array($moveCoordinates)) {
            $message .= ' (' . join(',', $moveCoordinates) . ')';
        }

        parent::__construct($message, $code, $previous);
    }
}