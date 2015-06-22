<?php

namespace t1gor\RobotsTxt\State;

/**
 * Class ReadDirective
 * @package t1gor\RobotsTxt\State
 */
final class ReadDirective extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'read-directive';
    }
}