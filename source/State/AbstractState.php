<?php

namespace t1gor\RobotsTxt\State;

use t1gor\RobotsTxt\Directive\DirectiveInterface;

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
     * @var \t1gor\RobotsTxt\Directive\DirectiveInterface
     */
    protected $currentDirective;

    /**
     * @var \t1gor\RobotsTxt\Directive\DirectiveInterface
     */
    protected $previousDirective;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param DirectiveInterface $d
     * @return $this
     */
    public function setPreviousDirective(DirectiveInterface $d)
    {
        $this->previousDirective = $d;
        return $this;
    }

    /**
     * @param DirectiveInterface $d
     * @return $this
     */
    public function setCurrentDirective(DirectiveInterface $d)
    {
        $this->currentDirective = $d;
        return $this;
    }

    /**
     * @return DirectiveInterface
     */
    public function getCurrentDirective()
    {
        return $this->currentDirective;
    }

    /**
     * @return DirectiveInterface
     */
    public function getPreviousDirective()
    {
        return $this->previousDirective;
    }
}