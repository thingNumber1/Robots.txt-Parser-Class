<?php

namespace t1gor\RobotsTxt\State;

/**
 * Class SkipSpace
 * @package t1gor\RobotsTxt\State
 */
final class SkipSpace extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'skip-space';
    }
}