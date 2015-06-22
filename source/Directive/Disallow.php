<?php

namespace t1gor\RobotsTxt\Directive;

/**
 * Class Disallow
 * @package t1gor\RobotsTxt\Directive
 */
final class Disallow extends AbstractDirective implements DirectiveInterface
{
    /**
     * Set directive name
     */
    public function __construct() {
        $this->name = 'disallow';
    }
}