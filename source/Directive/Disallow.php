<?php

namespace t1gor\RobotsTxt\Directive;

use t1gor\RobotsTxt\Parser;

/**
 * Class Disallow
 * @package t1gor\RobotsTxt\Directive
 */
final class Disallow extends AbstractDirective implements DirectiveInterface
{
    /**
     * @var string
     */
    protected static $name = 'disallow';

    /**
     * @param Parser $p
     * @return void
     */
    public function addRule(Parser $p)
    {
        $cWord = $p->getContent()->getCurrentWord();

        if ('' === $cWord) {
            return;
        }

        $p->addRule(['AbstractDirective', 'prepareRegexRule']);
    }
}