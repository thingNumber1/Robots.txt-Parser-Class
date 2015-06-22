<?php

namespace t1gor\RobotsTxt\State;

/**
 * Class ZeroPoint
 * @package t1gor\RobotsTxt\State
 */
final class ZeroPoint extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'zero-point';
    }
}