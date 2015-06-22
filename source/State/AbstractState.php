<?php

namespace t1gor\RobotsTxt\State;

/**
 * Class AbstractState
 * @package t1gor\RobotsTxt\Directive
 */
abstract class AbstractState
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }
}