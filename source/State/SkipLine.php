<?php

namespace t1gor\RobotsTxt\State;

/**
 * Class SkipLine
 * @package t1gor\RobotsTxt\State
 */
final class SkipLine extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'skip-line';
    }
}