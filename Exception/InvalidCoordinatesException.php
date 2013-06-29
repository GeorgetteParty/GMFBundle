<?php

namespace GeorgetteParty\GMFBundle\Exception;

/**
 * Can pass the Coordinates as second parameter,
 * they will be automatically dumped at the end of the message.
 *
 * Class IllegalMoveException
 * @package GeorgetteParty\GMFBundle\Exception
 */
class InvalidCoordinatesException extends \Exception
{
    public function __construct($message = "", $coordinates = null, $code = 0, \Exception $previous = null)
    {
        if (!empty($coordinates)) {
            $message .= ' (' . join((array)$coordinates,',') . ')';
        }

        parent::__construct($message, $code, $previous);
    }
}