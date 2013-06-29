<?php

namespace GeorgetteParty\GMFBundle\Space;

use GeorgetteParty\UnicodeTesselationBundle\Driver\Cube;
use GeorgetteParty\UnicodeTesselationBundle\Iterator\CubeFacesIterator;

use GeorgetteParty\GMFBundle\Model\GoGame;
use GeorgetteParty\GMFBundle\Exception\IllegalMoveException;
use GeorgetteParty\GMFBundle\Exception\InvalidCoordinatesException;
use GeorgetteParty\GMFBundle\Util\Math;
use GeorgetteParty\GMFBundle\Util\MultiArrayIndex as Index;


/**
 * This is a lattice for the faces of a quadsphere
 * Responsibilities :
 * - Coordinates Index
 * - Coordinates Factory => (make all, and later filter using perlin noise)
 * - Adjacency / Pathfinding
 *
 * This Lattice does not care about content.
 * (it could, with the interfaces and traits that the Board uses)
 * It is more like a CoordinatesSystem, GMF-wise
 * It cares about adjacency, pathfinding and such.
 * (The Space will have similar concerns and it will use these to make its own, with access to its Objects)
 * (eg: pathfinding around enemies, go stone groups...)
 *
 * Coordinates use internally a cube cartesian CS, with the origin at the center of the cube.
 * Only coordinates on the surface of the cube are created.
 * More information in the README.
 *
 * Thinking :
 * What use could we find for a Quadsphere class ? Or Interface ?
 *
 * Class QuadsphereFacesBoard
 * @package GeorgetteParty\GMFBundle\Space
 */
class QuadsphereFacesLattice implements CoordinatesSystem
{

    const X_INDEX = 0;
    const Y_INDEX = 1;
    const Z_INDEX = 2;

    /**
     * This class uses an options-based constructor
     * @var array
     */
    public $options = array();

    /**
     * @var array Index used as Coordinates Index
     */
    protected $index = array();

    /**
     * @param array $options Array of options, merged with $defaultOptions
     */
    public function __construct($options = array())
    {
        $defaultOptions = array(
            'size' => 1,
        );

        // merge options
        $this->options = array_replace_recursive($defaultOptions, $this->options, $options);

        // Coordinates factory -- populates the Coordinates Index
        // these loops are lousy, as they loop too much -- hack away !
        $m = $this->options['size'];
        $index = array();
        for ($ux = 0; $ux <= 2 * $m; $ux++) {
            $x = $ux - $m;
            for ($uy = 0; $uy <= 2 * $m; $uy++) {
                $y = $uy - $m;
                for ($uz = 0; $uz <= 2 * $m; $uz++) {
                    $z = $uz - $m;
                    // some (x,y,z) sets made here are invalid
                    // and we looped through all the valid
                    $valid = false;
                    try {
                        $c = new QuadsphereFacesCoordinates(array($x, $y, $z));
                        $c->validate();
                        $this->validate($c);
                        $valid = true;
                    } catch ( InvalidCoordinatesException $e ) {}

                    if ($valid) {
                        Index::set($index, array($x, $y, $z), $c);
                    }
                }
            }
        }
        Index::sortByKeys($index);
        $this->index = $index;

    }

    public function doesPossess(QuadsphereFacesCoordinates $c)
    {
        $v = Index::get($this->index, (array)$c);

        return $v !== null;
    }

    /**
     * Makes sure that passed Coordinates components fit in the Lattice
     * It is used internally to validate the set as belonging to this Lattice,
     * without using the indexation nor the filters
     *
     * Once the Coordinates of this Lattice have been created and indexed,
     * use the public method `doesPossess(Coordinates)`
     * to quickly check the presence of your Coordinates in this Lattice.
     *
     * @param Coordinates $c
     * @return bool
     * @throws \GeorgetteParty\GMFBundle\Exception\InvalidCoordinatesException
     */
    protected function validate(Coordinates $c)
    {
        $x = $c[self::X_INDEX];
        $y = $c[self::Y_INDEX];
        $z = $c[self::Z_INDEX];

        $size = $this->getSize();

        $ax = abs($x); // absolute
        $ay = abs($y);
        $az = abs($z);

        $ux = odd($x + $size);
        $uy = odd($y + $size);
        $uz = odd($z + $size);

        if ( // within cube surface, and on the faces lattice      /\
            ($ax == $size & $ay < $size & $uy & $az < $size & $uz) ||
            ($ay == $size & $ax < $size & $ux & $az < $size & $uz) ||
            ($az == $size & $ax < $size & $ux & $ay < $size & $uy) ){
            return true; //                                      -~§§~-
        } else { //                                          To the skies !
            throw new InvalidCoordinatesException("Not in the bare Lattice",$c);
        }
    }

    /**
     * The size of our quadsphere lattice is the number
     * of tiles along an edge of the original cube
     *
     * Incidentally, +size and -size are respectively
     * the min and max values of this C.S.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->options['size'];
    }


    public function getIndex()
    {
        return $this->index;
    }



    /**
     * Normalizes input coordinates.
     * DUPLICATE !
     *
     * @param $coordinates
     * @return array
     * @throws \GeorgetteParty\GMFBundle\Exception\InvalidCoordinatesException
     */
    protected function arrayize($coordinates)
    {
        if ($coordinates instanceof Coordinates) {
            $keys = (array) $coordinates;
        } else if (is_array($coordinates)) {
            $keys = $coordinates;
        } else {
            throw new InvalidCoordinatesException("FUUUU",$coordinates);
        }

        return $keys;
    }

    /**
     * Returns the Coordinates object
     *
     * @param array $coordinatesArray
     * @throws InvalidCoordinatesException
     * @return Coordinates
     */
    public function findAt($coordinatesArray)
    {
        $coordinatesArray = $this->arrayize($coordinatesArray);
        $coordinates = Index::get($this->index, $coordinatesArray);
        if (null == $coordinates) {
            throw new InvalidCoordinatesException("No Coordinates object at ", $coordinatesArray);
        }

        return $coordinates;
    }



    /**
     * Returns a array of at most four (4) coordinates arrays
     * Well, exactly 4 Coordinates, if we implement biome-generation in the board
     * @param Coordinates $coordinates
     * @return array
     */
    public function getNeighbors(Coordinates $coordinates)
    {
        $neighbors = array();

        // find cube face tangent axis (value is -size or size)
        $tangentAxisOffset = $this->getOffsetOfCubeFaceAxis($coordinates);
        // rotate coords so that tangent axis is first, lat's call them `a,b,c`
        $abc = (array)$coordinates;
        array_rotate_left($abc, $tangentAxisOffset);

        // iterate through all 4 neighbors :
        $neighborsData = array(
            array( $abc[0], $abc[1]+2, $abc[2]+0 ), // a, b+2, c
            array( $abc[0], $abc[1]+0, $abc[2]+2 ), // a, b-2, c
            array( $abc[0], $abc[1]-2, $abc[2]+0 ), // a, b, c+2
            array( $abc[0], $abc[1]+0, $abc[2]-2 ), // a, b, c-2
        );

        foreach ($neighborsData as $data)
        {
            array_rotate_left($data,-$tangentAxisOffset);
            $this->normalize($data);
            $c = Index::get($this->index, $data);
            if ($c) $neighbors[] = $c;
        }

        return $neighbors;
    }

    protected function needsToNormalize($coords)
    {
        $s = $this->getSize();
        $normal = true;

        $i = 3; while ($i--) { // no foreach, we want the first 3
            $c = $coords[$i];
            if ($c < -$s || $c > $s) $normal = false;
        }

        return !$normal;
    }

    /**
     * Returns the offset of the first found overflown component
     *
     *     /!\
     *     Assumes there's at least one component overflowing
     *     (returns 0 if not)
     *
     * @param $coords
     * @return int
     */
    protected function getOffsetOfOverflowedAxis(&$coords)
    {
        $s = $this->getSize();
        $i = 3; while ( $i-- && $coords[$i] <= $s && $coords[$i] >= -$s );

        return $i;
    }



    protected function getOffsetOfCubeFaceAxis(&$coords)
    {
        $s = $this->getSize();
        $i = 3; while ( $i-- && abs($coords[$i]) !== $s );

        return $i;
    }

    public function normalize(&$coords)
    {
        $s = $this->getSize();
        if ($this->needsToNormalize($coords)) {

            $over = $this->getOffsetOfOverflowedAxis($coords);
            $face = $this->getOffsetOfCubeFaceAxis($coords);

            $o = $coords[$over];
            $f = $coords[$face];

            $coords[$over] = boundarize($o,-$s,$s);
            $coords[$face] = $f - sign($f) * abs($o - sign($o) * $s);

        }
    }

    /**
     * Mutates $coordinates in Coordinates object if it is an array.
     * Does nothing if it is already a Coordinates object.
     * Throws otherwise.
     *
     * @param $coordinates
     * @return Coordinates
     * @throws InvalidCoordinatesException
     */
    public function sanitizeCoordinates(&$coordinates)
    {
        if ($coordinates instanceof Coordinates) {
            return $coordinates;
        } else if (is_array($coordinates)) {
            return $coordinates = new QuadsphereFacesCoordinates($coordinates);
        } else {
            throw new InvalidCoordinatesException("Only Array or Coordinates");
        }
    }



    // DEPRECATED //

    /**
     * Is the provided ($x, $y, $z) tuple a valid coordinates set for our lattice ?
     *
     * @deprecated
     *
     * @param $x int|array
     * @param $y int
     * @param $z int
     * @return bool
     */
    public function areCoordinatesValid($x, $y=null, $z=null)
    {
        if (is_array($x)) list($x,$y,$z) = $x;

        $valid = false;
        try {
            $c = new QuadsphereFacesCoordinates(array($x, $y, $z));
            $c->validate();
            $valid = true;
            unset($c);
        } catch ( InvalidCoordinatesException $e ) {}

        return $valid;
    }



}
