<?php

namespace Goutte\QuadsphereGoBundle\Tests;

use Exception;

/**
 * Test the global php functions defined in global_functions.php
 *
 * Some of them are not tested (yet). Fell free
 *
 * Class GlobalFunctionsTest
 * @package Goutte\QuadsphereGoBundle\Tests
 */
class GlobalFunctionsTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function tearDown()
    {

    }

    public function testArrayRotateLeft()
    {
        $a = array(4,5,6);
        array_rotate_left($a, 1);
        $this->assertEquals(array(5,6,4), $a, "Rotate a numeric array by 1");

        $a = array(4,'a',6);
        array_rotate_left($a, 2);
        $this->assertEquals(array(6,4,'a'), $a, "Rotate a numeric array by 2");

        $a = array(4,5,6);
        array_rotate_left($a, 4);
        $this->assertEquals(array(5,6,4), $a, "Rotate by more than the length");

        $a = array(4,5,6);
        array_rotate_left($a, -1);
        $this->assertEquals(array(6,4,5), $a, "Rotate a numeric array by -1");

        $a = array('a'=>42,'b'=>27,'c'=>13);
        $fail = true;
        try {
            array_rotate_left($a, 1);
        } catch (Exception $e) {
            $fail = false;
        }
        if ($fail) $this->fail("Throw when array is not numeric");
    }

    protected $odd_numbers = array(
         1,
        -1,
        99,
    );

    protected $even_numbers = array(
         0,
         2,
        -6,
        42,
    );

    public function testOdd()
    {
        foreach ($this->odd_numbers as $odd)
        {
            $this->assertTrue(odd($odd),"odd($odd) = true");
        }
        foreach ($this->even_numbers as $even)
        {
            $this->assertFalse(odd($even),"odd($even) = false");
        }
    }

}

