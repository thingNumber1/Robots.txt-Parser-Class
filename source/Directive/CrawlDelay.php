<?php

namespace t1gor\RobotsTxt\Directive;

use t1gor\RobotsTxt\Parser;

/**
 * Class CrawlDelay
 * @package t1gor\RobotsTxt\Directive
 */
final class CrawlDelay extends AbstractDirective implements DirectiveInterface
{
    /**
     * @var string
     */
    protected static $name = 'crawl-delay';

    /**
     * @param Parser $p
     * @return void
     */
    public function addRule(Parser $p)
    {
        $p->addRule('floatval', false);
    }
}