<?php

namespace GeorgetteParty\GMFBundle\Exception;

/**
 * Can pass the array of coordinates (x,y,z) as second parameter,
 * it will be automatically dumped at the end of the message.
 *
 * todo: It should accept a Move, not coordinates. (not sure about that)
 *
 * This is also a base class for you Exceptions.
 *
 * Class IllegalMoveException
 * @package GeorgetteParty\GMFBundle\Exception
 */
class IllegalMoveException extends \Exception
{
    protected $coordinates;

    public function __construct($message = "", $moveCoordinates = null, $code = 0, \Exception $previous = null)
    {
        if (is_array($moveCoordinates)) {
            $this->coordinates = $moveCoordinates;
            $message .= ' (' . join(',', $moveCoordinates) . ')';
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array|null
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
}