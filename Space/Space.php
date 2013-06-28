<?php

namespace Goutte\QuadsphereGoBundle\Space;

/**
 * This is a WIP with no particular goal
 *
 * Traits' traits implementing this :
 * - MultiArrayObjectsIndexation (DONE)
 * - Flat (slow'n ugly)
 * - Index (would-be magic indexation class)
 *
 */
interface Space
{

    /**
     * SizedSpace interface ?
     * @return int
     */
    public function getSize();

    /**
     * Should add an object with Coordinates to the Space,
     * so that the Space may retrieve it in other mathods.
     *
     * @param Positionable $object
     */
    public function addObject(Positionable $object);

    /**
     * Should return all objects added to the Space
     *
     * @return array
     */
    public function getObjects();

    /**
     * Should return all objects added to the Space
     * that are at the provided Coordinates
     *
     * @param Coordinates|array $coordinates
     * @return array
     */
    public function getObjectsAt($coordinates);

    // later on, in a child interface
    //public function getNeighbors(Positionable $p);
    // paths, rays, fov, etc.

}
