<?php

namespace t1gor\RobotsTxt\Directive;

use \t1gor\RobotsTxt\Parser;

/**
 * Interface DirectiveInterface
 * @package t1gor\RobotsTxt\Directive
 */
interface DirectiveInterface
{
    /**
     * @return string
     */
    public static function getName();

    /**
     * @param string $word
     * @return bool
     */
    public function matches($word);

    /**
     * @param Parser $p
     * @return void
     */
    public function addRule(Parser $p);
}