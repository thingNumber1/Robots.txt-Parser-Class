<?php

namespace t1gor\RobotsTxt\State;

use t1gor\RobotsTxt\Directive\DirectiveInterface;
use t1gor\RobotsTxt\Parser;

/**
 * Interface StateInterface
 * @package t1gor\RobotsTxt\State
 */
interface StateInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param Parser $p
     * @return Parser
     */
    public function process(Parser $p);

    /**
     * @param DirectiveInterface $d
     * @return $this
     */
    public function setPreviousDirective(DirectiveInterface $d);

    /**
     * @param DirectiveInterface $d
     * @return $this
     */
    public function setCurrentDirective(DirectiveInterface $d);

    /**
     * @return DirectiveInterface
     */
    public function getPreviousDirective();

    /**
     * @return DirectiveInterface
     */
    public function getCurrentDirective();
}