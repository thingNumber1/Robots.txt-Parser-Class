<?php

namespace t1gor\RobotsTxt\Directive;

use t1gor\RobotsTxt\Parser;

/**
 * Class Host
 * @package t1gor\RobotsTxt\Directive
 */
final class Host extends AbstractDirective implements DirectiveInterface
{
    /**
     * @var string
     */
    protected static $name = 'host';

    /**
     * @param Parser $p
     * @return void
     */
    public function addRule(Parser $p)
    {
        $p->addRule('trim', false);
    }
}