<?php

namespace t1gor\RobotsTxt\Directive;

use \t1gor\RobotsTxt\Parser;

/**
 * Class UserAgent
 * @package t1gor\RobotsTxt\Directive
 */
final class UserAgent extends AbstractDirective implements DirectiveInterface
{
    /**
     * @var string
     */
    protected static $name = 'user-agent';

    /**
     * @param Parser $p
     */
    public function addRule(Parser $p)
    {
        $agent = $p->getContent()->getCurrentWord();
        $p->setUserAgent($agent);
    }
}