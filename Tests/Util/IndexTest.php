<?php

namespace Goutte\QuadsphereGoBundle\Tests;

use Exception;
//use Goutte\QuadsphereGoBundle\Util\Index;
use Goutte\QuadsphereGoBundle\Util\MultiArrayIndex as Index;

/**
 * WIP
 * 
 * 
 * 
 * Class IndexTest
 * @package Goutte\QuadsphereGoBundle\Tests
 */
class IndexTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Short 2d multiarray for testing static methods
     * @var
     */
    public $ma;

    public function setUp()
    {
        $this->ma = array(
            'a'=>array(
                0 => 10,
                1 => 11,
            ),
            'b'=>array(
                'c' => 42,
            ),
        );
        
    }

    public function tearDown()
    {

    }


    public function testStaticGet()
    {
        $this->assertEquals($this->ma['a'][1], Index::get($this->ma, array('a',1)), 'Index::get(&$array, $keys) 1/2');
        $this->assertEquals($this->ma['b']['c'], Index::get($this->ma, array('b','c')), 'Index::get(&$array, $keys) 2/2');

        $this->assertNull(Index::get($this->ma, array('?','¿')), "Return null when not found");
    }

    public function testStaticRemove()
    {
        Index::remove($this->ma, array('b','c'));

        $this->assertNull(Index::get($this->ma, array('b','c')), "Remove value");
        $this->assertCount(1, $this->ma, "Remove empty array(s)");

        Index::remove($this->ma, array('a',0));
        Index::remove($this->ma, array('a',1));

        $this->assertEquals(array(), $this->ma, "Always leave the root array");

        Index::remove($this->ma, array('?','¿'));
        $this->assertEquals(array(), $this->ma, "Silently ignore not found");
        // should it ? or shoud it throw like a greek discobole ?
    }

}

