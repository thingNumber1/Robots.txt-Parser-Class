<?php

namespace t1gor\RobotsTxt\Directive;

use \BadMethodCallException;

/**
 * Interface DirectiveInterface
 * @package t1gor\RobotsTxt\Directive
 */
abstract class AbstractDirective
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Default simple implementation - if equals
     * @param string $word
     * @return bool
     */
    public function matches($word)
    {
        return $word === $this->name;
    }

    /**
     * By default - not implemented
     * @return string
     * @throws \BadMethodCallException
     */
    public function getValue()
    {
        throw new BadMethodCallException('Not implemented');
    }
}