<?php

namespace Gmf\GmfBundle\Tests\Core;

use Gmf\GmfBundle\Brick\ViewBrick;
use Gmf\GmfBundle\Core\GameCore;
use Gmf\GmfBundle\Exception\RenderException;

class GameCoreTests extends \PHPUnit_Framework_TestCase
{
    /**
     * Should initialize game cores
     */
    public function testInit()
    {
        $core = new GameCore();
        $bricks = $core->getBricks();

        $this->assertTrue(is_array($bricks), 'GameCore failed to initialize !');

        // testing add bricks
        $nbOfBricks = count($bricks);
        $core->addBrick(new ViewBrick());
        // should one more brick
        $this->assertEquals($nbOfBricks + 1, count($core->getBricks()), 'GameCore failed to add a brick !');
    }

    /**
     * Should return a string
     *
     */
    public function testRender()
    {
        $core = new GameCore();

        $raised = false;
        try {
            $core->render();
        } catch (\Gmf\GmfBundle\Exception\RenderException $e) {
            $raised = true;
        }
        $this->assertTrue($raised, 'It should raise a Render Exception if it has no view brick');

        $core->addBrick(new ViewBrick());
        $render = $core->render();

        $this->assertEquals('', $render, 'It should render nothing if it has an empty view brick');

        // core should have a empty render now
        //$this->assertNotEquals('', $render, 'GameCore has an empty render !');
    }
}