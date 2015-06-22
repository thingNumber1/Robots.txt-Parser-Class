<?php

namespace t1gor\RobotsTxt\Directive;

/**
 * Class UserAgent
 * @package t1gor\RobotsTxt\Directive
 */
final class UserAgent extends AbstractDirective implements DirectiveInterface
{
    /**
     * Set directive name
     */
    public function __construct() {
        $this->name = 'user-agent';
    }
}