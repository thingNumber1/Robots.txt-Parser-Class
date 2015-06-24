<?php

namespace t1gor\RobotsTxt\State;

use t1gor\RobotsTxt\Parser;

/**
 * Class SkipLine
 * @package t1gor\RobotsTxt\State
 */
final class SkipLine extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'skip-line';
    }

    /**
     * @param Parser $p
     * @return Parser
     */
    public function process(Parser $p)
    {
        $p->getContent()->increment();
        $p->setState(new ZeroPoint());
        return $p;
    }
}