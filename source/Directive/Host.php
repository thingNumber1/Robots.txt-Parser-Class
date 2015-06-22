<?php

namespace t1gor\RobotsTxt\Directive;

/**
 * Class Host
 * @package t1gor\RobotsTxt\Directive
 */
final class Host extends AbstractDirective implements DirectiveInterface
{
    /**
     * Set directive name
     */
    public function __construct() {
        $this->name = 'host';
    }
}