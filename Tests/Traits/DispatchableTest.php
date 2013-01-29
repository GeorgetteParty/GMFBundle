<?php

namespace Gmf\GmfBundle\Tests\Traits;

class DispatchableTest extends \PHPUnit_Framework_TestCase
{
    public function testDispatch()
    {
        $dispatchableMock = $this->getObjectForTrait('\Gmf\GmfBundle\Traits\Dispatchable');
        $dispatchable = new \ReflectionClass($dispatchableMock);

        // should have a method which return a event dispatcher
        $this->assertTrue($dispatchable->hasMethod('getEventDispatcher'), 'Trait Dispatchable has not method getEventDispatcher');
        $this->assertTrue($dispatchable->hasMethod('setEventDispatcher'), 'Trait dispatchable has not method setEventDispatcher');
        $this->assertTrue($dispatchable->hasMethod('addListener'), 'Trait Dispatchable has not method addListener');
        $this->assertTrue($dispatchable->hasMethod('dispatch'), 'Trait Dispatchable has not method dispatch');

        $parameters = $dispatchable->getMethod('addListener')->getParameters();
        $this->assertEquals('Gmf\GmfBundle\Event\Listener', $parameters[1]->getClass()->getName(),
            'Second parameter of method "addListener" in Dispatchable Trait should be an instance of \Gmf\GmfBundle\Event\Listener');
    }
}