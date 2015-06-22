<?php

namespace t1gor\RobotsTxt\State;

/**
 * Class ReadValue
 * @package t1gor\RobotsTxt\State
 */
final class ReadValue extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'read-value';
    }
}