<?php

namespace Gmf\GmfBundle\Tests\Core;

use Gmf\GmfBundle\Brick\GameBrick;
use Gmf\GmfBundle\Core\GameCore;
use Gmf\GmfBundle\Event\Event;

class GameCoreTests extends \PHPUnit_Framework_TestCase
{
    /**
     * Should initialize game cores
     */
    public function testInit()
    {
        // init method should raise GameCoreInit event
        $listener = $this->getMock('\Gmf\GmfBundle\Event\Listener', array('onGameCoreInit'));
        $listener->expects($this->once())->method('onGameCoreInit');

        $core = $this->getFakeCore();
        $core->getEventDispatcher()->addListener(Event::GAMECORE_INIT, array($listener, 'onGameCoreInit'));

        // core should not have bricks yet
        $this->assertTrue($core->getBricks() == null, 'GameCore failed to initialize !');
        // core init
        $core->init();
        // bricks should be initialized
        $this->assertTrue(is_array($core->getBricks()), 'GameCore failed to initialize !');

    }

    public function testLoad()
    {
        // load should raise GameCoreLoad event
        $listener = $this->getMock('\Gmf\GmfBundle\Event\Listener', array('onGameCoreLoad'));
        $listener->expects($this->once())->method('onGameCoreLoad');

        $core = $this->getFakeCore();
        $core->getEventDispatcher()->addListener(Event::GAMECORE_LOAD, array($listener, 'onGameCoreLoad'));
        $core->init(); // to delete, replace with a mock
        $core->load();
    }

    public function testAddBrick()
    {
        $core = $this->getFakeCore();
        // testing add bricks
        $core->addBrick(new GameBrick());
        // should one more brick
        $this->assertEquals(1, count($core->getBricks()), 'GameCore failed to add a brick !');
    }

    /**
     * Should return a string
     */
    public function testRender()
    {
        $core = $this->getFakeCore();
        // brick instantiable ?
        $core->addBrick(new GameBrick());

        $this->assertEquals('', $core->render(), 'It should render nothing if it has an empty view brick');
    }

    // use phpunit mock later
    protected function getFakeCore()
    {
        return $core = new GameCore();
    }
}