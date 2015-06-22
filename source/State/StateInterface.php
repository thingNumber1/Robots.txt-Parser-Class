<?php

namespace t1gor\RobotsTxt\State;

/**
 * Interface StateInterface
 * @package t1gor\RobotsTxt\State
 */
interface StateInterface
{
    public function getName();
    public function process();
}