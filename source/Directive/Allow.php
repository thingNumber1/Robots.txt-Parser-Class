<?php

namespace t1gor\RobotsTxt\Directive;

use t1gor\RobotsTxt\Parser;

/**
 * Class Allow
 * @package t1gor\RobotsTxt\Directive
 */
final class Allow extends AbstractDirective implements DirectiveInterface
{
    /**
     * @var string
     */
    protected static $name = 'allow';

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