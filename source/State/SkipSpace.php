<?php

namespace t1gor\RobotsTxt\State;

use t1gor\RobotsTxt\Parser;

/**
 * Class SkipSpace
 * @package t1gor\RobotsTxt\State
 */
final class SkipSpace extends AbstractState implements StateInterface
{
    public function __construct() {
        $this->name = 'skip-space';
    }

    /**
     * @param Parser $p
     * @return Parser
     */
    public function process(Parser $p)
    {
        $p->getContent()
            ->increment()
            ->setWordToLastChar();

        return $p;
    }
}