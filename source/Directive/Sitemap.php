<?php

namespace t1gor\RobotsTxt\Directive;

/**
 * Class Sitemap
 * @package t1gor\RobotsTxt\Directive
 */
final class Sitemap extends AbstractDirective implements DirectiveInterface
{
    /**
     * Set directive name
     */
    public function __construct() {
        $this->name = 'sitemap';
    }
}