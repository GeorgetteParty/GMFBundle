<?php

namespace GeorgetteParty\GMFBundle\Exception;

/**
 * Can pass the array of coordinates (x,y,z) as second parameter,
 * it will be automatically dumped at the end of the message.
 *
 * todo: It should accept a Move, not coordinates.
 *
 * This is also a base class for you Exceptions.
 *
 * Class IllegalMoveException
 * @package GeorgetteParty\GMFBundle\Exception
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