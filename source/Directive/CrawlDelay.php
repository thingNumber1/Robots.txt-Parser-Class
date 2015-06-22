<?php

namespace t1gor\RobotsTxt\Directive;

/**
 * Class CrawlDelay
 * @package t1gor\RobotsTxt\Directive
 */
final class CrawlDelay extends AbstractDirective implements DirectiveInterface
{
    /**
     * Set directive name
     */
    public function __construct() {
        $this->name = 'crawl-delay';
    }
}