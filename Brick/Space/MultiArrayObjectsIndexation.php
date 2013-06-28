<?php

namespace Goutte\QuadsphereGoBundle\Brick\Space;

use ArrayObject;
use GeorgetteParty\UnicodeTesselationBundle\Iterator\CubeFacesIterator;
use Goutte\QuadsphereGoBundle\Exception\InvalidCoordinatesException;
use Goutte\QuadsphereGoBundle\Is\Analyzable;
use Goutte\QuadsphereGoBundle\Space\Coordinates;
use Goutte\QuadsphereGoBundle\Space\Is\Positionable;
use Goutte\QuadsphereGoBundle\Util\MultiArrayIndex;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Implements Space
 * MultiArray Objects Indexation : Use a multiarray to index objects added to space
 *
 * As I can't fathom anything else we might use (another Trait on par with this one),
 * this is probably going into an heritable(s) class(es), like BasicSpace (!?)
 *
 * fixme: removeObject !
 *
 * Also, we could all mentions of Coordinates and replace by Keys,
 * and make a Trait for Space and one for a more generic indexation of `Indexable` Objects
 *
 * Trait MultiArrayObjectsIndexation
 * @package Goutte\QuadsphereGoBundle\Brick\Space
 */
trait MultiArrayObjectsIndexation
{

    /**
     * This is the Index :
     * A 3D multiarray holding the board data, array[$x][$y][$z] = Collection of Positionable
     * Each $value is a Positionable instance.
     *
     * @var array
     */
    protected $objects = array();

    /**
     * Should add an object with Coordinates to the Space,
     * so that the Space may retrieve it in other mathods.
     *
     * @param Positionable $object
     * @throws Exception when $this->objects is FUBAR
     */
    public function addObject(Positionable $object)
    {
        $keys = $object->getCoordinates();

        $collection = MultiArrayIndex::get($this->objects,$keys);

        if (null == $collection) {
            $collection = new ArrayObject(array($object));
        } else if ($collection instanceof \ArrayAccess) {
            $collection[] = $object;
        } else {
            throw new Exception("The Objects Index holds Collections");
        }

        MultiArrayIndex::set(
            $this->objects,
            $object->getCoordinates(),
            $collection
        );

        if ($this instanceof Analyzable) $this->setAnalysisNeed(true);
    }

    /**
     * Remove from Space an Object previously added.
     *
     * /!\ fails silently if object was never added.
     *
     * @param Positionable $object
     */
    public function removeObject(Positionable $object)
    {
        MultiArrayIndex::remove($this->objects, $object->getCoordinates());

        if ($this instanceof Analyzable) $this->setAnalysisNeed(true);
    }

    /**
     * Should return all objects added to the Space,
     * in the form of a flat array of Positionables.
     *
     * @return Positionable[]
     */
    public function getObjects()
    {
        $objects = array();
        $iterator = new CubeFacesIterator($this->getObjectsIndex());
        foreach ($iterator as $currentTile) {
            foreach ($currentTile as $current) {
                $objects[] = $current;
            }
        }

        return $objects;
    }

    /**
     * Should return all objects added to the Space,
     * in the form of an Index.
     *
     * @see $objects
     *
     * @return array
     */
    public function getObjectsIndex()
    {
        return $this->objects;
    }

    /**
     * Returns the single Object added at provided $coordinates
     * Throws if there is more than one object
     * Returns null if there is none
     */
    public function getObjectAt($coordinates)
    {
        $objects = $this->getObjectsAt($coordinates);
        $count = count($objects);
        if (0 == $count) {
            return null;
        } else if (1 == $count) {
            return $objects[0];
        } else {
            throw new InvalidCoordinatesException("There is more than one object at these coordinates", $coordinates);
        }
    }

    /**
     * Should return all objects added to the Space
     * that are at the provided Coordinates
     *
     * fixme: this needs sanitization somewhere along the chain, but not here i think
     *
     * @param Coordinates|array $coordinates
     * @throws \Goutte\QuadsphereGoBundle\Exception\InvalidCoordinatesException
     * @return array
     */
    public function getObjectsAt($coordinates)
    {
        return MultiArrayIndex::get($this->objects, (array)$coordinates);
    }


    /**
     * Checks for absence of objects located at $coordinates.
     *
     * @param Coordinates|array $coordinates
     * @return bool
     */
    public function areThereObjectsAt($coordinates)
    {
        $objects = $this->getObjectsAt($coordinates);
        return empty($objects);
    }


    /**
     * What are the Coordinates of the Objects added to this Space ?
     * Collects only unique Coordinates.
     *
     * @return Coordinates[] A flat array of Coordinates
     */
    public function getObjectsCoordinates()
    {
        $coordinates = array(); // flat array of coords
        $objects = $this->getObjects();

        foreach ($objects as $object) {
            $c = $object->getCoordinates();
            if (!in_array($c,$coordinates)) {
                $coordinates[] = $c;
            }
        }

        return $coordinates;
    }


}