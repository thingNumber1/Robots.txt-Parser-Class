<?php

namespace t1gor\RobotsTxt;

/**
 * Class Repository
 *
 * Instantiate a state class from the same namespace.
 *
 * @package t1gor\RobotsTxt\State
 */
final class Repository
{
    /**
     * @var array
     */
    protected $instances = array();

    /**
     * Get an instance
     * @param string $className
     * @return mixed
     */
    public function get($className)
    {
        // already have it
        if (array_key_exists($className, $this->instances)) {
            return $this->instances[$className];
        }

        // don't have an instance
        $this->instances[$className] = new $className();
        return $this->instances[$className];
    }
}